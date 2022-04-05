<?php
	
class CatalogController extends Controller
{
	public function actionFavorites()
	{
		if (Yii::app()->request->isAjaxRequest) {
			$favValue = Yii::app()->request->getPost('fav');
			$ids = $favValue ? json_decode($favValue) : [];
			
			$criteria = new CDbCriteria();
			$criteria->addInCondition('id', $ids);			
			
			$dataProvider = new CActiveDataProvider('Product', [
				'criteria' => $criteria
			]);
			
			$this->renderPartial('favorites_list', [
				'dataProvider' => $dataProvider,
			]);
			Yii::app()->end();
		}
		
		$this->prepareSeo('Избранное');
		$this->render('favorites');
	}
	
	public function actionList()
	{
		
	}
}