<?php

class SkriptController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('index', 'view'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create', 'update', 'admin', 'delete'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Skript'),
		));
	}

	public function actionCreate() {
		$model = new Skript;
        $model->user_iduser = Yii::app()->user->id;
        //CVarDumper::dump(CJSON::decode( $_POST['jsonout'] ),10,true);
		$this->performAjaxValidation($model, 'skript-form');
		if (isset($_POST['Skript'])) {
			$model->setAttributes($_POST['Skript']);
            $model->user_iduser = Yii::app()->user->id;

            $model->zeit = time();
			if ($model->save()) {
				/*if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else*/
                foreach($_POST['Skript']['spraches'] as $sprache){
                    $mod = new SkriptHasSprache();
                    $mod->skript_idskript = $model->idskript;
                    $mod->sprache_idsprache = $sprache;
                    $do = new convert($sprache);
                    $mod->gen_skript = $do->parse(CJSON::decode( $model->json_skript));
                    $mod->save();
                }

					$this->redirect(array('view', 'id' => $model->idskript));
			}
		}

        $test = array(
                array(
                    "value" => "bla",
                    "type" => "echo",
                    "child"=>NULL
                ),
                array(
                    "value"=>"0",
                    "type" => "var",
                    "name"=>"vari",
                    "child"=>NULL
                ),
                array(
                    "value" => "vari == 0",
                    "type" => "if",
                    "child"=>array(
                        array(
                                    "value" => "bla 1",
                                    "type" => "echo",
                                    "child"=>NULL
                                ),
                    )
                ),
            );
        $js_test = CJSON::encode($test);
        //$model->json_skript = $js_test;
        $model->json_skript = $_POST['jsonout'];

        $do = new convert(1);
        //echo nl2br($do->parse( CJSON::decode( $js_test ) ));

        //echo "test:".nl2br($do->parse( CJSON::decode( $_POST['jsonout'] ) ));

		$this->render('create', array( 'model' => $model ));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Skript');

		$this->performAjaxValidation($model, 'skript-form');

		if (isset($_POST['Skript'])) {
			$model->setAttributes($_POST['Skript']);
			$relatedData = array(
				'spraches' => $_POST['Skript']['spraches'] === '' ? null : $_POST['Skript']['spraches'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('view', 'id' => $model->idskript));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Skript')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Skript');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Skript('search');
		$model->unsetAttributes();

		if (isset($_GET['Skript']))
			$model->setAttributes($_GET['Skript']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}