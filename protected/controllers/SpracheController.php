<?php

class SpracheController extends GxController {

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
			'model' => $this->loadModel($id, 'Sprache'),
		));
	}

	public function actionCreate() {
		$model = new Sprache;

		$this->performAjaxValidation($model, 'sprache-form');

		if (isset($_POST['Sprache'])) {
			$model->setAttributes($_POST['Sprache']);
			$relatedData = array(
				'skripts' => $_POST['Sprache']['skripts'] === '' ? null : $_POST['Sprache']['skripts'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->idsprache));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Sprache');

		$this->performAjaxValidation($model, 'sprache-form');

		if (isset($_POST['Sprache'])) {
			$model->setAttributes($_POST['Sprache']);
			$relatedData = array(
				'skripts' => $_POST['Sprache']['skripts'] === '' ? null : $_POST['Sprache']['skripts'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('view', 'id' => $model->idsprache));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Sprache')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Sprache');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Sprache('search');
		$model->unsetAttributes();

		if (isset($_GET['Sprache']))
			$model->setAttributes($_GET['Sprache']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}