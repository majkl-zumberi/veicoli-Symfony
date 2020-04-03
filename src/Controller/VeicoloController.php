<?php
namespace App\Controller;

use App\Interfaces\TipologiaInterface;
use App\Service\CatalogoService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class VeicoloController extends AbstractController

{
 
    private $mio_service;
    public $tabella_inquinamento = [
        'ecologiche' => ['da' => 0 , 'a' => 30000],
        'poco inquinanti'=> ['da' => 30000 , 'a' => 60000],
        'inquinanti' => ['da' => 60000 , 'a' => 1000000],
        ];

    public function __construct(CatalogoService $mio_service)
    {
    $this->mio_service = $mio_service;
    }
   
    
    public function getVeicoli(Request $request)
    {
            $sort = $request->query->get('sort');
            $orientation = $request->query->get('orientation');
            
            $filter = $request->query->get('filter');
            $value = $request->query->get('value');
        
        $this->mio_service->build(13, 7);
        $this->mio_service->setTabellaInquinamento($this->tabella_inquinamento);
                   
        
                    $ori = $orientation == 'desc' ? 'asc' : 'desc';
                    $lista=$this->mio_service->print($sort, $orientation, $filter, $value);;
                    return $this->render('lista-veicoli.html.twig', [
                        'tabella' => $lista,
                        'nome' => 'Majkl',
                        'filter' => empty($value) ? "?orientation=$ori" : "?orientation=$ori&filter=$filter&value=$value"

            ]
            );
            
        }
        public function getVeicolo(Request $request){
            $id = $request->query->get('id');
            $list = $this->mio_service->build(13, 7);
            $this->mio_service->setTabellaInquinamento($this->tabella_inquinamento);
            $item = $list[$id-1];
            $template = 'dettaglio-page-'.$item->getTipo().'.html.twig';
            
            return $this->render($template, [
            'item' => $item,
            ]);
            
            }
    
   }
