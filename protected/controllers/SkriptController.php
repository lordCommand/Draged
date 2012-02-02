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

		$this->performAjaxValidation($model, 'skript-form');

		if (isset($_POST['Skript'])) {
			$model->setAttributes($_POST['Skript']);
			$relatedData = array(
				'spraches' => $_POST['Skript']['spraches'] === '' ? null : $_POST['Skript']['spraches'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->idskript));
			}
		}

		$this->render('create', array( 'model' => $model));
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