<?php

namespace App\Controller;

use App\Exception\MissingParameterException;
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
        //assuming first name, last name, email address and password are required
        $firstName = $this->getRequiredParameterFromRequest('firstName', $request);
        $lastName = $this->getRequiredParameterFromRequest('lastName', $request);
        $emailAddress = $this->getRequiredParameterFromRequest('emailAddress', $request);
        $password = $this->getRequiredParameterFromRequest('password', $request);
        $middleName = $request->request->get('middleName', $request) ?? '';
        $dateOfBirth = $request->request->get('dateOfBirth', $request);

        return $this->json([
            'message' => 'User registered successfully',
            'data' => [
                'id' => uniqid('User_'),
                'name' => "$firstName {$middleName} $lastName",
            ]
        ], Response::HTTP_CREATED);
    }

    private function getRequiredParameterFromRequest(string $parameterName, Request $request)
    {
        $requiredParameter = $request->request->get($parameterName);
        if (!$requiredParameter) throw new MissingParameterException("$parameterName is required");
        return $requiredParameter;
    }
}
