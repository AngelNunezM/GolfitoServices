<?php 

namespace App\Controllers;

use App\Core\Helpers\HTTP;
use App\Core\Middlewares\Authentication;
use App\Core\View;
use App\Models\User;
use App\Services\UserService;
use Exception;

class UserController {

    use HTTP;

    private UserService $userService; 

    public function __construct(){
        $this->userService = new UserService();
    }

    public function index() 
    {
        Authentication::verify(['Administrador']);
        try {
            $users = $this->userService->getUsers();

            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "data" => $users
                ],  200);
            } else {
                View::render("users/Users", ["users" => $users]);
            }

        } catch (Exception $ex){
            if($this->isJsonRequest()){
                $this->response([
                    "success" => true,
                    "message" => $ex->getMessage()
                ], 500);
            } else {
                View::render("users/Users", ["error" => $ex->getMessage()]);
            }
        }
    }

    public function create(): void
    {
        //Authentication::verify();
        $request = $this->request();

        try {
            $user = User::create(
                name: $request['name'],
                username: $request['username'],
                password: $request['password'] ?? '',
                phone: $request['phone'],
                role_id: $request['role_id']
            );

            $isUserCreated = $this->userService->createUser($user);

            $this->response([
                "success" => true,
                "message" => "Usuario creado exitosamente",
                "data" => $isUserCreated
            ], 201);

        } catch (Exception $ex) {
            // Respuesta según tipo de request
            if ($this->isJsonRequest()) {
                $this->response([
                    'success' => false,
                    "message" => $ex->getMessage()
                ], 500);
            } else {
                View::render('user/create', ['error' => $ex->getMessage()]);
            }
        }
    }

    public function update(string $userId)
    {
        $request = $this->request();

        try {
            $user = new User(
                name: $request['name'],
                username: $request['username'],
                password: $request['password'] ?? '',
                phone: $request['phone'],
                role_id: $request['role_id'],
                id: $userId
            );

            $users = $this->userService->updateUser($user);

            $this->response([
                "success" => true,
                "message" => "Usuario actualizado exitosamente",
                "data" => $users
            ], 200);

        } catch (Exception $ex){
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function changeStatus(string $userId)
    {
        try {

            $user = $this->userService->changeUserStatus($userId);

            $this->response([
                "success" => true,
                "message" => "Estado del usuario actualizado exitosamente",
                "data" => $user
            ], 200);

        } catch (Exception $ex){
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

    public function show(string $userId)
    {
        try {
            $user = $this->userService->getUserById($userId);
            
            $this->response([
                "success" => true,
                "data" => $user
            ], 200);
        } catch (Exception $ex){
            $this->response([
                "success" => false,
                "message" => $ex->getMessage()
            ], 500);
        }
    }

}