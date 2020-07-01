<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class APIController extends AbstractController
{
    /**
     * @Route("/", name="api_index")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/APIController.php',
        ]);
    }

    /**
     * @Route("/register", name="register_user", methods={"POST"})
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $firstName = $this->getParameterFromRequest('firstName', $request);
        $middleName = $this->getParameterFromRequest('middleName', $request) ?? '';
        $lastName = $this->getParameterFromRequest('lastName', $request);
        $dateOfBirth = $this->getParameterFromRequest('dateOfBirth', $request);
        $emailAddress = $this->getParameterFromRequest('emailAddress', $request);
        $password = $this->getParameterFromRequest('password', $request);
        //assuming first name, last name, email address and password are required

        if (!$firstName) {
            return $this->json([
                'message' => 'firstName is required'
            ], Response::HTTP_BAD_REQUEST);
        }
        if (!$lastName) {
            return $this->json([
                'message' => 'lastName is required'
            ], Response::HTTP_BAD_REQUEST);
        }
        if (!$emailAddress) {
            return $this->json([
                'message' => 'emailAddress is required'
            ], Response::HTTP_BAD_REQUEST);
        }
        if (!$password) {
            return $this->json([
                'message' => 'password is required'
            ], Response::HTTP_BAD_REQUEST);
        }
        return $this->json([
            'message' => 'User registered successfully',
            'data' => [
                'id' => uniqid('User_'),
                'name' => "$firstName {$middleName} $lastName",
            ]
        ], Response::HTTP_CREATED);
    }

    private function getParameterFromRequest(string $parameterName, Request $request)
    {
        return $request->request->get($parameterName);
    }
}
