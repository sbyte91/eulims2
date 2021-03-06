<?php

namespace common\models\finance;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\finance\Orderofpayment;

/**
 * OrderofpaymentSearch represents the model behind the search form about `common\models\finance\Orderofpayment`.
 */
class OrderofpaymentSearch extends Orderofpayment
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['orderofpayment_id', 'rstl_id', 'collectiontype_id', 'customer_id', 'created_receipt'], 'integer'],
            [['transactionnum', 'order_date', 'purpose'], 'safe'],
            [['amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Orderofpayment::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'orderofpayment_id' => $this->orderofpayment_id,
            'rstl_id' => $this->rstl_id,
            'collectiontype_id' => $this->collectiontype_id,
            'order_date' => $this->order_date,
            'customer_id' => $this->customer_id,
            'amount' => $this->amount,
            'created_receipt' => $this->created_receipt,
        ]);

        $query->andFilterWhere(['like', 'transactionnum', $this->transactionnum])
            ->andFilterWhere(['like', 'purpose', $this->purpose]);

        return $dataProvider;
    }
    
}
