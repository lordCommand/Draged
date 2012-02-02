<?php

class ElementController extends GxController {

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
			'model' => $this->loadModel($id, 'Element'),
		));
	}

	public function actionCreate() {
		$model = new Element;

		$this->performAjaxValidation($model, 'element-form');

		if (isset($_POST['Element'])) {
			$model->setAttributes($_POST['Element']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->idelement));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Element');

		$this->performAjaxValidation($model, 'element-form');

		if (isset($_POST['Element'])) {
			$model->setAttributes($_POST['Element']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->idelement));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Element')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Element');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Element('search');
		$model->unsetAttributes();

		if (isset($_GET['Element']))
			$model->setAttributes($_GET['Element']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}