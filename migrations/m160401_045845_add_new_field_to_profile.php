<?php

use yii\db\Migration;

/**
 * Handles adding the columns  * for table `profile`.
 */
class m160401_045845_add_new_field_to_profile extends Migration {

    /**
     * @inheritdoc
     */
    public function up() {
        $this->addColumn('{{%profile}}', 'hospcode', Schema::TYPE_STRING);
    }

    /**
     * @inheritdoc
     */
    public function down() {
        $this->dropColumn('{{%profile}}', 'hospcode');
    }

}
