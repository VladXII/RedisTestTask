<?php

namespace App\Controller;


use App\String\StringValue;
use Predis\Client;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class StringController extends AbstractController
{
    /**
     * @Route("/string", methods={"POST"}, name="string_create")
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function createAction(Request $request)
    {
        $value = $request->get('value', '');
        $uuid = Uuid::uuid4()->toString();
        $redis = $this->getClient();

        $model = new StringValue($uuid, $value);
        $redis->set($model->getUid(), $model->getValue());

        return new JsonResponse($model->toArray());
    }

    /**
     * @Route("/string/{uid}", methods={"GET"}, name="string_get")
     * @param string $uid
     * @return Response
     */
    public function getAction(string $uid)
    {
        $redis = $this->getClient();

        $value = $redis->get($uid);
        if (!$value) {
            throw new NotFoundHttpException();
        }
        $model = new StringValue($uid, $value);

        return new JsonResponse($model->toArray());
    }

    /**
     * @return Client
     */
    private function getClient(): Client
    {
        $redis = new Client(
            [
                "scheme" => "tcp",
                "host" => "redis",
            ]
        );

        return $redis;
    }
}
