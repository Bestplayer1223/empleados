<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\EmpleadoRol;
use App\Models\Rol;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ServicesController extends Controller
{
    /**
     *  Allows to return an specific response and status HTTP from de API
     */
    public function returnResponse($type, $data = null, $message, $error = null)
    {

        if ($type == 1) {
            return response()->json([
                'message' => $message,
                'data' => $data,
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        } else if ($type == 2) {
            return response()->json([
                'message' => $message,
                'error' => $error,
                'status' => Response::HTTP_INTERNAL_SERVER_ERROR
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        } else if ($type == 3) {
            return response()->json([
                'message' => $message,
                'status' => Response::HTTP_BAD_REQUEST
            ], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     *  Allows to create new  records to the table "empleado_rol"
     */
    public function createRolesWorker($worker_id, $roles){
        try {
            foreach ($roles as $value) {
                $record = EmpleadoRol::create(['empleado_id' => $worker_id, 'rol_id' => $value]);
                if($record == false){
                    return false;
                }
            }
            return true;

            } catch (\Exception $e)
            {
                return false;
            }
    }


    /**
     *  Allows to delete the records from the table "empleado_rol"
     */
    public function deleteRolesWorker($worker_id){

        $result = EmpleadoRol::where('empleado_id',$worker_id)->delete();
        return $result;
    }


    /**
     *  Returns all records from the table "areas"
     */
    public function showAllAreas(){
        $areas =  Area::orderBy('id','asc')
        ->get();
        $type = 1;
        $data = $areas;
        $message = 'All Areas';
        return $this->returnResponse($type, $data, $message);
    }


    /**
     *  Returns all records from the table "roles"
     */
    public function showAllRoles(){
        $roles =  Rol::orderBy('id','asc')
        ->get();
        $type = 1;
        $data = $roles;
        $message = 'All roles';
        return $this->returnResponse($type, $data, $message);
    }

}
