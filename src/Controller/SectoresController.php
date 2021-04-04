<?php

namespace App\Controller;

use App\Entity\Sectores;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\Column\TwigColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;

class SectoresController extends AbstractController {

    protected $sectores;

    #[Route('/sectores', name: 'sectores')]
    public function index(): Response {
        return $this->render('sectores/index.html.twig', [
                    'controller_name' => 'SectoresController',
        ]);
    }

    /**
     * Devuelve un sector por id
     */
    public function getSector(int $id) {
        $sector = $this->getDoctrine()
                ->getRepository(Sectores::class)
                ->find($id);
        if (!$sector) {
            throw $this->createNotFoundException(
                            'No existe el sector con id: ' . $id
            );
        }

        return $sector;
    }

    /**
     * Genera el formulario para crear un nuevo sector
     * @Route("/sector/new", name="form_new_sector")
     */
    public function formNewSector(Request $request): Response {

        $sector = new Sectores();

        $form = $this->createFormBuilder($sector)
                ->add('nombre', TextType::class)
                ->add('save', SubmitType::class, ['label' => 'Guardar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $sector = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sector);
            $entityManager->flush();

            return $this->redirectToRoute('sector_showAll');
        }


        return $this->render('sectores/create.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * Genera el formulario para editar un sector
     * @Route("/sector/edit/{id}", name="form_edit_sector")
     */
    public function formEditSector(Request $request, int $id): Response {

        $sector = $this->getSector($id);

        $form = $this->createFormBuilder($sector)
                ->add('nombre', TextType::class)
                ->add('save', SubmitType::class, ['label' => 'Guardar'])
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $sector = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sector);

            $entityManager->flush();
            return $this->redirectToRoute('sector_showAll');
        }

        return $this->render('sectores/create.html.twig', [
                    'form' => $form->createView(),
        ]);
    }

    /**
     * Genera una pagina de confirmacion para borrar unç sector
     * @Route("/sector/eliminarConfirmacion/{id}", name="deleteConfirm_sector")
     */
    public function deleteConfirmSector(Request $request, int $id): Response {
        return $this->render('sectores/delete.html.twig', [
                    'id' => $id,
        ]);
    }

    /**
     * GBorra un sector
     * @Route("/sector/eliminar/{id}", name="delete_sector")
     */
    public function deleteSector(Request $request, int $id): Response {

        $sector = $this->getSector($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($sector);
        $entityManager->flush();

        return $this->redirectToRoute('sector_showAll');
    }

    /**
     * Devuelve todos los  sectores
     * @Route("/sector/all", name="sector_showAll")
     */
    public function showAll(Request $request, DataTableFactory $dataTableFactory) {

        $table = $dataTableFactory->create()
                ->add('id', TextColumn::class, ['label' => 'Id', 'visible' => false])
                ->add('nombre', TextColumn::class, ['label' => 'Nombre'])
                ->createAdapter(ORMAdapter::class, [
                    'entity' => Sectores::class,
                ])
                ->add('acciones', TwigColumn::class, [
                    'label' => 'Acciones',
                    'className' => 'buttons',
                    'template' => 'sectores/buttonbar.html.twig',
                ])
                ->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }

        return $this->render('sectores/datos.html.twig', ['datatable' => $table]);
    }

}
