<?php

namespace app\moduls\budgetreq\components;

use app\modules\budgetreq\models\PhOperationOrder;

class CdataCustom {

    public function getDataorder($id, $order_id) {
        $model = PhOperationOrder::find()->where(['request_id' => $id, 'order_id' => $order_id]);
        return $model;
    }

}
