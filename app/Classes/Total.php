<?php

namespace App\Classes;

class Total
{
    protected $incoming = [];
    protected $costs = [];

    public function countTotal($transactions)
    {
        foreach($transactions as $transaction)
        {
            if($transaction->type == 1)
            {
                $this->incoming[] = $transaction->amount;
            }else{
                $this->costs[] = $transaction->amount;
            }
        }

        $total = array_sum($this->incoming) - array_sum($this->costs);
        return $total;
    }
}