<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Test;
use AppBundle\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{
    
    public function numberAction($count)
    {
        $number = rand(0, 100);
        
        $data = array(
            'lucky number' => $number,
            'count' => $count
        );
        
        $html = $this->container->get('templating')->render(
            'test.html.twig',
            array('luckyNumberList' => $data)
        );
        
        $test = new Test();
        $test->setName("test");
        $test->setPrice($number);
        
        $this->getDoctrine()->getManager()->persist($test);
        $this->getDoctrine()->getManager()->flush();
                
        return new Response(
            $html
        );
    }
    
    public function createAction(Request $request)
    {
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();
        
        $form->handleRequest($request);

        return $this->render('default/create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    
    public function calculate($a, $b)
    {
        return $a+$b;
    }
}