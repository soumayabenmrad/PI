<?php

namespace AdminBundle\Controller;

use FixBundle\Entity\Annonce;
use FixBundle\Entity\Categorie;
use FixBundle\Entity\Souscategorie;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Zend\Json\Expr;

class GrapheController extends Controller
{


    public function chartHistogrammeAction()
    {
        $series = array(
            array(
                'name' => 'Client',
                'type' => 'column',
                'color' => '#4572A7',
                'yAxis' => 1,
                'data' => array(49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4),
            ),

        );
        $yData = array(
            array(
                'labels' => array(
                    'formatter' => new Expr('function () { return this.value + " degrees C" }'),
                    'style' => array('color' => '#AA4643')
                ),
                'title' => array(
                    'text' => '',
                    'style' => array('color' => '#AA4643')
                ),
                'opposite' => False,
            ),
            array(
                'labels' => array(
                    'formatter' => new Expr('function () { return this.value + "" }'),
                    'style' => array('color' => '#4572A7')
                ),
                'gridLineWidth' => 0,
                'title' => array(
                    'text' => 'Client',
                    'style' => array('color' => '#4572A7')
                ),
            ),
        );

  $categories = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
  $ob = new Highchart();
  $ob->chart->renderTo('container'); // The #id of the div where to render the chart
  $ob->chart->type('column');
  $ob->title->text('Nombre de client et des professionnels');
  $ob->xAxis->categories($categories);
  $ob->yAxis($yData);
  $ob->legend->enabled(false);
  $formatter = new Expr('function () {
var unit = {
"Rainfall": "m",
"Temperature": "degrees C"
}[this.series.name];
return this.x + ": <b>" + this.y + "</b> " + unit;
}');
$ob->tooltip->formatter($formatter);
$ob->series($series);
return $this->render('@Admin/Statistics/lineCharts.html.twig' ,array(
    'chart' => $ob
));
}

    public function chartPieAction(){
        $em = $this->getDoctrine()->getRepository(Categorie::class)->findtotale();
        $i = sizeof($em);
        $em = $this->getDoctrine()->getRepository(Annonce::class)->findtotaleAnnonce();
        $a = sizeof($em);
        $em = $this->getDoctrine()->getRepository(Souscategorie::class)->findtotaleSC();
        $s = sizeof($em);
        $ob = new Highchart();
        $ob->chart->renderTo('piechart');
        $ob->title->text('les nombres de notre plateform');
        $ob->plotOptions->pie(array(
            'allowPointSelect' => true,
            'cursor' => 'pointer',
            'dataLabels' => array('enabled' => false),
            'showInLegend' => true
        ));
        $data = array(
            array('Professionnels', 45.0),
            array('categorie', $i),
            array('client', 12.8),
            array('annonce', $a),
            array('reclamation', 6.2),
            array('sous categorie', $s),
        );
        $ob->series(array(array('type' => 'pie','name' => 'Quantité', 'data' => $data)));
        return $this->render('@Admin/Statistics/Pie.html.twig', array(
            'chart' => $ob
        ));
    }




}
