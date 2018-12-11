<?php


namespace JMP\Controllers;


use Interop\Container\ContainerInterface;
use JMP\Models\User;
use JMP\Services\Auth;
use JMP\Services\UserService;
use JMP\Utils\Converter;
use Slim\Http\Request;
use Slim\Http\Response;

class UsersController
{

    /**
     * @var Auth
     */
    private $auth;
    /**
     * @var UserService
     */
    private $userService;

    /**
     * EventController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->auth = $container->get('auth');
        $this->userService = $container->get('userService');
    }

    /**
     * Returns the user or an error
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function createUser(Request $request, Response $response): Response
    {
        // TODO (dominik): Make a middleware which checks the permissions and creates the error response
        // Check user for admin permissions
        if ($this->auth->requestAdmin($request)->isFailure()) {
            // No token supplied
            if ($request->getAttribute('token')) {
                return $response->withStatus(401);
            } else {
                // Token supplied, but no admin permissons
                return $response->withStatus(403);
            }
        }

        // TODO (dominik): Make a middleware which checks for errors and creates the error response
        if ($request->getAttribute('has_errors')) {
            $errors = $request->getAttribute('errors');
            return $response->withJson(['errors' => $errors], 400);
        }

        $user = $request->getParsedBody();

        // check if the username is already used by an other user
        if ($this->userService->isUsernameUnique($user['username'])) {
            return $this->usernameAvailable($response, $user);
        } else {
            return $this->usernameNotAvailable($response, $user);
        }
    }

    /**
     * Create the error response if a username is already in use
     * @param Response $response
     * @param $user
     * @return Response
     */
    private function usernameNotAvailable(Response $response, $user): Response
    {
        return $response->withJson([
            'errors' => [
                'User' => 'A user with the username ' . $user['username'] . ' already exists'
            ]
        ], 400);
    }

    /**
     * Create the response if a user can be created successfully
     * @param Response $response
     * @param $user
     * @return Response
     */
    private function usernameAvailable(Response $response, $user): Response
    {
        $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);

        $user = $this->userService->createUser(new User($user));

        return $response->withJson(Converter::convert($user));
    }


}