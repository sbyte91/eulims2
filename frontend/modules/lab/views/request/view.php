<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use common\components\Functions;


$sweetalert = new Functions();

/* @var $this yii\web\View */
/* @var $model common\models\lab\Request */

$this->title = empty($model->request_ref_num) ? $model->request_id : $model->request_ref_num;
$this->params['breadcrumbs'][] = ['label' => 'Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$rstlID=$GLOBALS['rstl_id'];
$Year=date('Y', strtotime($model->request_datetime));
$js=<<<SCRIPT
    $("#btnSaveRequest").click(function(){
        $.post(this.value, {
            request_id: $model->request_id,
            lab_id: $model->lab_id,
            rstl_id: $rstlID,
            year: $Year
        }, function(result){
           if(result){
               location.reload();
           }
        });
    });  
       
SCRIPT;
$this->registerJs($js);
?>
<div class="request-view">
    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <!-- <p>
        <?= Html::a('Update', ['update', 'id' => $model->request_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->request_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> -->

   <!--  <?php /*= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'request_id',
            'request_ref_num',
            'request_datetime:datetime',
            'rstl_id',
            'lab_id',
            'customer_id',
            'payment_type_id',
            'modeofrelease_id',
            'discount',
            'discount_id',
            'purpose_id',
            'or_id',
            'total',
            'report_due',
            'conforme',
            'receivedBy',
            'created_at',
            'posted',
            'status_id',
        ],
    ])*/ ?> -->
    <div class="container">
        <?php
            echo DetailView::widget([
            'model'=>$model,
            'responsive'=>true,
            'hover'=>true,
            'mode'=>DetailView::MODE_VIEW,
            'panel'=>[
                'heading'=>'<i class="glyphicon glyphicon-book"></i> Request # ' . $model->request_ref_num,
                'type'=>DetailView::TYPE_PRIMARY,
            ],
            'buttons1' => '',
            'attributes'=>[
                [
                    'group'=>true,
                    'label'=>'Request Details',
                    'rowOptions'=>['class'=>'info']
                ],
                [
                    'columns' => [
                        [
                            'attribute'=>'request_ref_num', 
                            'label'=>'Request Reference Number',
                            'displayOnly'=>true,
                            'valueColOptions'=>['style'=>'width:30%']
                        ],
                        [
                            //'attribute'=>'request_datetime',
                            'label'=>'Customer / Agency',
                            'format'=>'raw',
                            'value'=>$model->customer->customer_name,
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            'label'=>'Request Date',
                            'format'=>'raw',
                            'value'=>Yii::$app->formatter->asDate($model->request_datetime, 'php:F j, Y'),
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                        [
                            //'attribute'=>'request_datetime',
                            'label'=>'Address',
                            'format'=>'raw',
                            'value'=>$model->customer->address,
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                    
                ],
                [
                    'columns' => [
                        [
                            'label'=>'Request Time',
                            'format'=>'raw',
                            'value'=>Yii::$app->formatter->asDate($model->request_datetime, 'php:h:i a'),
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                        [
                            //'attribute'=>'request_datetime',
                            'label'=>'Tel no.',
                            'format'=>'raw',
                            'value'=>$model->customer->tel,
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            'attribute'=>'report_due',
                            'label'=>'Report Due Date',
                            'format'=>'raw',
                            'value'=>Yii::$app->formatter->asDate($model->request_datetime, 'php:F j, Y'),
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                        [
                            //'attribute'=>'request_datetime',
                            'label'=>'Fax no.',
                            'format'=>'raw',
                            'value'=>$model->customer->fax,
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                ],
                [
                    'group'=>true,
                    'label'=>'Payment Details',
                    'rowOptions'=>['class'=>'info']
                ],
                [
                    'columns' => [
                        [
                            //'attribute'=>'request_ref_num', 
                            'label'=>'OR No.',
                            'value'=>'',
                            'displayOnly'=>true,
                            'valueColOptions'=>['style'=>'width:30%']
                        ],
                        [
                            //'attribute'=>'request_datetime',
                            'label'=>'Collection',
                            'format'=>'raw',
                            'value'=>'0',
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                ],
                [
                    'columns' => [
                        [
                            //'attribute'=>'request_ref_num', 
                            'label'=>'OR Date',
                            'value'=>'',
                            'displayOnly'=>true,
                            'valueColOptions'=>['style'=>'width:30%']
                        ],
                        [
                            //'attribute'=>'request_datetime',
                            'label'=>'Unpaid Balance',
                            'format'=>'raw',
                            'value'=>'0',
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                ],
                
                [
                    'group'=>true,
                    'label'=>'Transaction Details',
                    'rowOptions'=>['class'=>'info']
                ],
                [
                    'columns' => [
                        [
                            'attribute'=>'receivedBy', 
                            //'label'=>'Request Reference Number',
                            'format'=>'raw',
                            'displayOnly'=>true,
                            'valueColOptions'=>['style'=>'width:30%']
                        ],
                        [
                            'attribute'=>'conforme',
                            //'label'=>'Conforme',
                            'format'=>'raw',
                            //'value'=>$model->customer->customer_name,
                            'valueColOptions'=>['style'=>'width:30%'], 
                            'displayOnly'=>true
                        ],
                    ],
                ],
            ],

        ]);
        ?>
    </div>

    <div class="container">
        <div class="table-responsive">
        <?php
            $gridColumns = [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'sample_code',
                    'enableSorting' => false,
                    'contentOptions' => [
                        'style'=>'max-width:70px; overflow: auto; white-space: normal; word-wrap: break-word;'
                    ],
                ],
                [
                    'attribute'=>'samplename',
                    'enableSorting' => false,
                ],
                [
                    'attribute'=>'description',
                    'format' => 'raw',
                    'enableSorting' => false,
                    'value' => function($data){
                        return ($data->request->lab_id == 2) ? "Sampling Date: <span style='color:#000077;'><b>".$data->sampling_date."</b></span>,&nbsp;".$data->description : $data->description;
                    },
                   'contentOptions' => [
                        'style'=>'max-width:180px; overflow: auto; white-space: normal; word-wrap: break-word;'
                    ],
                ],
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{delete}',
                    'dropdown' => false,
                    'dropdownOptions' => ['class' => 'pull-right'],
                    //'urlCreator' => function($action, $model, $key, $index) { return '#'; },
                    'urlCreator' => function ($action, $model, $key, $index) {
                        /*if ($action === 'update') {
                            $url ='index.php?r=client-login/lead-update&id='.$model->id;
                            return $url;
                        }*/
                        if ($action === 'delete') {
                            $url ='/lab/sample/delete?id='.$model->sample_id;
                            return $url;
                        }

                    },
                    /*'viewOptions' => ['title' => 'This will launch the book details page. Disabled for this demo!', 'data-toggle' => 'tooltip'],
                    'updateOptions' => ['title' => 'This will launch the book update page. Disabled for this demo!', 'data-toggle' => 'tooltip'],*/
                    'deleteOptions' => ['title' => 'Delete Sample', 'data-toggle' => 'tooltip'],
                    //'buttons' => [
                        /*'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('app', 'lead-view'),
                            ]);
                        },

                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('app', 'lead-update'),
                            ]);
                        },*/
                        /*'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url);
                        }*/

                    //],
                    'headerOptions' => ['class' => 'kartik-sheet-style'],
                ],
            ];

            echo GridView::widget([
                'id' => 'sample-grid',
                'dataProvider'=> $sampleDataProvider,
                //'summary' => '',
                //'showPageSummary' => true,
                //'showHeader' => true,
                //'showPageSummary' => true,
                //'showFooter' => true,
                //'template' => '{update} {delete}',
                'pjax'=>true,
                'pjaxSettings' => [
                    'options' => [
                        'enablePushState' => false,
                    ]
                ],
                'responsive'=>true,
                'striped'=>true,
                'hover'=>true,
                //'filterModel' => $searchModel,
               // 'toggleDataOptions' => ['minCount' => 10],
                'panel' => [
                    'heading'=>'<h3 class="panel-title">Samples</h3>',
                    'type'=>'primary',
                    //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add Sample', ['/lab/sample/create','request_id'=>$model->request_id], ['class' => 'btn btn-success']),
                    'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add Sample', ['value' => Url::to(['sample/create','request_id'=>$model->request_id]),'title'=>'Add Sample', 'onclick'=>'addSample(this.value,this.title)', 'class' => 'btn btn-success','id' => 'modalBtn'])." ".Html::button('<i class="glyphicon glyphicon-plus"></i> Generate Samplecode', ['value' => Url::to(['sample/generatesamplecode','request_id'=>$model->request_id]),'title'=>'Add Sample', 'onclick'=>'addSample(this.value,this.title)', 'class' => 'btn btn-success','id' => 'modalBtn']),
                    //'after'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add Sample', ['value' => Url::to(['sample/create','request_id'=>$model->request_id]),'title'=>'Add Sample', 'onclick'=>'addSample(this.value,this.title)', 'class' => 'btn btn-success','id' => 'modalBtn']),
                    //'after'=>'',
                    'after'=>false,
                    //'footer'=>false,
                ],
                'rowOptions' => function ($model, $key, $index, $grid) {
                    return [
                        //'id' => $model->sample_id,
                        'id' => $model->sample_id,
                        //'id' => $data['request_id'],
                        //'onclick' => 'alert(this.id);',
                        'onclick' => 'updateSample('.$model->sample_id.');',
                        'style' => 'cursor:pointer;',
                        //'onclick' => 'updateSample(this.id,this.request_id);',
                        // [
                        //     'data-id' => $model->sample_id,
                        //     'data-request_id' => $model->request_id
                        // ],
                    ];
                },
                'columns' => $gridColumns,
                'toolbar' => [
                    'content'=> Html::a('<i class="glyphicon glyphicon-repeat"></i>', [Url::to(['request/view','id'=>$model->request_id])], [
                                'class' => 'btn btn-default', 
                                'title' => 'Reset Grid'
                            ]),
                    '{toggleData}',
                ],
                /*'toolbar' => [
                    [
                        'content'=>
                            Html::button('<i class="glyphicon glyphicon-plus"></i>', [
                                'type'=>'button', 
                                //'title'=>Yii::t('kvgrid', 'Add Book'), 
                                'class'=>'btn btn-success'
                            ]) . ' '.
                            Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['request-grid'], [
                                'class' => 'btn btn-default', 
                                //'title' => Yii::t('kvgrid', 'Reset Grid')
                            ]),
                    ],
                    //'{export}',
                    //'{toggleData}'
                ],*/
            ]);
        ?>
        </div>
    </div>
    <div class="container">
        <?php
            $gridColumns = [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute'=>'request_id',
                    'enableSorting' => false,
                ],
                [
                    'attribute'=>'request_ref_num',
                    'enableSorting' => false,
                ],
                [
                    'attribute'=>'report_due',
                    'enableSorting' => false,
                ],
            ];
            echo GridView::widget([
                'id' => 'analysis-grid',
                'dataProvider'=> $dataProvider,
                'summary' => '',
                'responsive'=>true, 
                'hover'=>true,
                //'filterModel' => $searchModel, JANEEDI 
                'panel' => [
                    'heading'=>'<h3 class="panel-title">Analysis</h3>',
                    'type'=>'primary',
                    //'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Add Analysis', ['/lab/analysis/create'], ['class' => 'btn btn-success'],['id' => 'modalBtn']),
                    'before'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add Analysis', ['value' => Url::to(['analysis/create','request_id'=>$model->request_id]),'title'=>'Add Analyses', 'onclick'=>'addSample(this.value,this.title)', 'class' => 'btn btn-success','id' => 'modalBtn'])."   ".
                    Html::button('<i class="glyphicon glyphicon-plus"></i> Add Package', ['value' => Url::to(['/services/packagelist/createpackage','request_id'=>$model->request_id]),'title'=>'Add Package', 'onclick'=>'addSample(this.value,this.title)', 'class' => 'btn btn-success','id' => 'modalBtn'])." ".
                    Html::button('<i class="glyphicon glyphicon-plus"></i> Additional Fees', ['value' => Url::to(['sample/create','request_id'=>$model->request_id]),'title'=>'Add Additional Fees', 'onclick'=>'addSample(this.value,this.title)', 'class' => 'btn btn-success','id' => 'modalBtn']),
                   'after'=>false,
                  //  'after'=>Html::button('<i class="glyphicon glyphicon-plus"></i> Add Analysis', ['value' => Url::to(['sample/create','request_id'=>1]),'title'=>'Add Analysis', 'class' => 'btn btn-success','id' => 'modalBtn']),
                   'footer'=>"<div class='row' style='margin-left: 2px;padding-top: 5px'><button value='/lab/request/saverequestransaction' id='btnSaveRequest' class='btn btn-success'><i class='fa fa-save'></i> Save Request</button></div>",
                ],
                'columns' => $gridColumns,
                'toolbar' => [
                ],
            ]);
        ?>
    </div>
</div>
<script type="text/javascript">
   /*$("#modalBtn").click(function(){
        $(".modal-title").html($(this).attr('title'));
        $("#modal").modal('show')
        //$("#sampleModal").modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });*/

     $('#sample-grid tbody td').css('cursor', 'pointer');

    function updateSample(id){
       //var url = 'Url::to(['sample/update']) . "?id=' + id;
       var url = '/lab/sample/update?id='+id;
        $('.modal-title').html('Update Sample');
        $('#modal').modal('show')
            .find('#modalContent')
            .load(url);
    }

    function addSample(url,title){
       //var url = 'Url::to(['sample/update']) . "?id=' + id;
       //var url = '/lab/sample/update?id='+id;
        $(".modal-title").html(title);
        $('#modal').modal('show')
            .find('#modalContent')
            .load(url);
    }
</script>
<?php
$this->registerJs("
    /*$('td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if(e.target == this)
            location.href = '" . Url::to(['accountinfo/update']) . "?id=' + id;
    });*/


    $('#sample-grid tbody td').css('cursor', 'pointer');
    /*$('tbody td').click(function (e) {
        var id = $(this).closest('tr').data('id');
        if (e.target == this)
            location.href = '" . Url::to(['sample/update']) . "?id=' + id;
    });*/
    // $('#sample-grid tbody td').click(function(e) {
    // //$('#sample-grid-pjax tbody tr').click(function() {
    //     e.preventDefault();
    //     var id = $(this).closest('tr').data('id');
    //     var url = '" . Url::to(['sample/update']) . "?id=' + id;
    //     $('.modal-title').html('Update Sample');
    //     $('#modal').modal('show')
    //         .find('#modalContent')
    //         .load(url);
    // });
/*$('#sample-grid tbody td').click(function() {
    var id = $(this).closest('tr').data('id');
    $('.modal-title').html('Update Sample');
        $('#modal').modal('show')
            .find('#modalContent').load(updateSample(id));
    
});*/

/*function updateSample(id)
{
    //var id = $(this).closest('tr').data('id');
    $.ajax({
        type: 'GET',
        // dataType: 'json',
        // data: {
        // 'user': 'A'
        // },
        //data: {id: $model->request_id},
        url: '" . Url::to(['sample/update']) . "?id=' + id,
        contentType: 'application/json',
        success: function(data) {
            console.log(typeof(data));
            console.log(data)
        },
        error: function (data) {
            console.log(data);
        },
    });
}*/
");
?>
<?php
    // This section will allow to popup a notification
    $session = Yii::$app->session;
    if ($session->isActive) {
        $session->open();
        if (isset($session['deletemessage'])) {
            $sweetalert->CrudAlert("Successfully Deleted","WARNING",true);
            unset($session['deletemessage']);
            $session->close();
        }
        if (isset($session['updatemessage'])) {
            $sweetalert->CrudAlert("Successfully Updated","SUCCESS",true);
            unset($session['updatemessage']);
            $session->close();
        }
        if (isset($session['savemessage'])) {
            $sweetalert->CrudAlert("Successfully Saved","SUCCESS",true);
            unset($session['savemessage']);
            $session->close();
        }
    }
?>