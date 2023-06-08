<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmpleadoRequest;
use App\Models\Empleado;
use App\Models\EmpleadoRol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmpleadoController extends Controller
{
    /**
     *  Instance of the controller ServiceController
     */
    public $servicesController;

    /**
     *  Class Construct
     */
    public function __construct()
    {
        $this->servicesController = new ServicesController();
    }

    /**
     *  Returns all workers from the table "empleado"
     */
    public function showAllWorkers()
    {
            $workers = Empleado::with(['foreignArea'])
            // ->groupBy('id')
            ->orderBy('id','asc')
            ->get();
            $type = 1;
            foreach ($workers as $worker) {
                $worker['roles'] = EmpleadoRol::where('empleado_id',$worker->id)->get();
            }
            $data = $workers;
            $message = 'All Workers';
            return $this->servicesController->returnResponse($type, $data, $message);
    }

    /**
     *  Returns the records of the "empleado" table that meet the filter
     */
    public function searchWorkersByFields(Request $request)
    {
        $query = Empleado::query()->with(['foreignArea']);
        foreach ($request->all() as $field => $value) {
            if (is_string($value)) {
                $query->where($field, 'LIKE', '%' . $value . '%');
            } else {
                $query->where($field, $value);
            }
        }
        $result = $query->get();
        if ($result)
        {
            $type = 1;
            $data = $result;
            $message = 'Result of the search';
        } else {
            $type = 1;
            $data = null;
            $message = 'Workers Not Found';
        }
        return $this->servicesController->returnResponse($type,$data,$message,null);
    }

    /**
     *  Allows to create a new record on the table "empleado"
     */
    public function createWorker(EmpleadoRequest $workerRequest){
        DB::beginTransaction();
        try {
            $validated = $workerRequest->validated();
            $result = Empleado::create($validated);
            $type = 1;
            $createRolesWorker = $this->servicesController->createRolesWorker($result->id,$validated['roles_id']);
            $data = $createRolesWorker;
            if($createRolesWorker == false){
                DB::rollBack();
                $type = 2;
                $error = 'Failed to insert in empleado_rol';
                $message = 'Failed to create Worker.';
                return $this->servicesController->returnResponse($type, null, $message,$error);
            }
            DB::commit();
            $message = 'Worker created successfully.';
            } catch (\Exception $e)
            {
                DB::rollBack();
                $type = 2;
                $error = $e->getMessage();
                $message = 'Failed to create Worker.';
                return $this->servicesController->returnResponse($type, null, $message,$error);
            }
            return $this->servicesController->returnResponse($type,$data,$message,null);
    }


    /**
     *  Allows to update a record from the table "empleado"
     */
    public function updateWorker(EmpleadoRequest $request, $id)
    {
        DB::beginTransaction();
        try
        {
            $worker = Empleado::findOrFail($id);
            $validated = $request->validated();
            $result = $worker->update($validated);
            $type = 1;
            $data = $result;

            $deleteRolesWorker = $this->servicesController->deleteRolesWorker($id);

            if($deleteRolesWorker == false){
                DB::rollBack();
                $type = 2;
                $error = 'Failed to delete from empleado_rol';
                $message = 'Failed to update Worker.';
                return $this->servicesController->returnResponse($type, null, $message,$error);
            } else {

            $createRolesWorker = $this->servicesController->createRolesWorker($id,$validated['roles_id']);

            if($createRolesWorker == false){
                DB::rollBack();
                $type = 2;
                $error = 'Failed to insert in empleado_rol';
                $message = 'Failed to update Worker.';
                return $this->servicesController->returnResponse($type, null, $message,$validated);
            }

            $data = $createRolesWorker;

            }
            DB::commit();
            $message = 'Worker updated successfully.';
        } catch (\Exception $e) {
            DB::rollBack();
            $type = 2;
            $error = $e->getMessage();
            $message = 'Failed to update the Worker.';
            return $this->servicesController->returnResponse($type, null, $message,$error);
        }
        return $this->servicesController->returnResponse($type,$data,$message,null);
    }

    /**
     *  Allows to update a record from the table "empleado"
     */
    public function deleteWorker($id)
    {
        DB::beginTransaction();
        try
        {
            $worker = Empleado::findOrFail($id);
            $deleteRolesWorker = $this->servicesController->deleteRolesWorker($id);
            $result = $worker->delete();
            $type = 1;

            if($deleteRolesWorker == false){
                DB::rollBack();
                $type = 2;
                $error = 'Failed to delete from empleado_rol';
                $message = 'Failed to update Worker.';
                return $this->servicesController->returnResponse($type, null, $message,$error);
            }
            DB::commit();
            $data = $deleteRolesWorker;
            $message = 'Worker Deleted Successfully.';
        } catch (\Exception $e) {
            $type = 2;
            $error = $e->getMessage();
            $message = 'Failed to Delete the Worker.';
            return $this->servicesController->returnResponse($type, null, $message,$error);
        }

        return $this->servicesController->returnResponse($type,$data,$message,null);
    }


}
