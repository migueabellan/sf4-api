<?php

namespace App\Controller\Api\v1;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;

/**
 * Class PartnerController
 *
 * @Route("/api/v1")
 */
class PartnerController extends FOSRestController
{
    /**
     * @Rest\Get("/partner", name="partner_list", defaults={"_format":"json"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Gets all partners for current logged user."
     * )
     *
     * @SWG\Response(
     *     response=500,
     *     description="An error has occurred trying to get partners."
     * )
     *
     * @SWG\Tag(name="Partner")
     */
    public function getPartners(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $serializer = $this->get('jms_serializer');

        try {
            $code = 200;
            $error = false;

            $data = $em->getRepository("App:Partner")->findAll();

        } catch (Exception $ex) {
            $code = 500;
            $error = true;

            $data = "An error has occurred trying to get partners - Error: {$ex->getMessage()}";
        }

        $response = [
            'code' => $code,
            'error' => $error,
            'data' => $data,
        ];

        return new Response($serializer->serialize($response, "json"));
    }



}