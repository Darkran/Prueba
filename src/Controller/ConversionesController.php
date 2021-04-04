<?php

namespace App\Controller;

use App\Entity\Conversiones;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType ;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConversionesController extends AbstractController {

    private $client;

    public function __construct(HttpClientInterface $client) {
        $this->client = $client;
    }

    #[Route('/conversiones', name: 'conversiones')]
    public function index(): Response {
        return $this->render('conversiones/index.html.twig', [
                    'controller_name' => 'ConversionesController',
        ]);
    }

    /**
     * Genera el formulario para enviar a la api, y una vez recivido los datos, los guarda en la db
     * @Route("/fixerConversion", name="convert")
     */
    public function convertCurrency(Request $request, HttpClientInterface $client): Response {

        $conversion = new Conversiones();

        $form = $this->createFormBuilder($conversion)
                ->add('origen', CurrencyType ::class, [
                    'label' => 'Moneda de origen',
                ])
                ->add('destino', CurrencyType ::class, [
                    'label' => 'Moneda destino',
                ])
                ->add('fecha', DateType::class, [
                    'label' => 'Fecha',
                    //'input' => 'string',
                    'widget' => 'single_text',
                ])
                ->add('cantidad', TextType::class, [
                    'label' => 'Cantidad',
                ])
                ->add('save', SubmitType::class, ['label' => 'Convertir'])
                ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $conversionData = $form->getData();
            $fecha = $conversionData->getFecha();
            $fecha = $fecha->format('Y-m-d');

            $response = $this->client->request(
                    'GET',
                    'http://data.fixer.io/api/convert?access_key=6692e05b747fb061427b312f9f692ea0&from='
                    . $conversionData->getOrigen() . '&to='
                    . $conversionData->getDestino() . '&amount='
                    . $conversionData->getCantidad() . '&date='
                    . $fecha . '',
            );

            $statusCode = $response->getStatusCode();
            // $statusCode = 200
            $contentType = $response->getHeaders()['content-type'][0];
            // $contentType = 'application/json'
            $content = $response->getContent();
            $content = $response->toArray();
            if ($content['error'] ==! false) {
                $error = true;
                return $this->render('conversiones/form.html.twig', [
                            'form' => $form->createView(),
                            'mensaje' => $error,
                ]);
            } else {
                //Guardar el historico en base de datos
                //He hecho varias pruebas y en todas me dice mi suscripcion con el APi no es la sufuciente como para
                //Usar esta funcion, lo que me impide guardar un historico.
                //Array ( [success] => [error] => Array ( [code] => 105 [type] => function_access_restricted [info] => Access Restricted - Your current Subscription Plan does not support this API Function. ) )
            }
        }


        return $this->render('conversiones/form.html.twig', [
                    'form' => $form->createView(),
                     'mensaje' => null,
        ]);
    }

}
