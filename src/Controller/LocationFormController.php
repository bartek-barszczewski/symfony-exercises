<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/location-form')]
class LocationFormController extends AbstractController
{
    #[Route('/new')]
    public function index( 
        Request $request,
        LocationRepository $locationRepository
    ): Response
    {
        $location = new Location();

        $form = $this->createFormBuilder($location)
            ->add('name', TextType::class, ['attr' => ['class' => 'cityName' ], 'required' => true ] )
            ->add('countryCode', TextType::class)
            ->add('latitude', NumberType::class, [ 'html5' => true, 'scale' => 7] )
            ->add('longitude', NumberType::class, [ 'html5' => true, 'scale' => 7] )
            ->add('Submit', SubmitType::class, ['label' => 'Add place' ])
            ->getForm();

            $form->handleRequest($request);
            if ( $form->isSubmitted() && $form->isValid() ) {
                 $locationRepository->save($location, true);
                 
                 return $this->redirectToRoute('app_location_index');
            }

        return $this->render('location_form/index.html.twig', [
            'form' => $form,
        ]);
    }
}
