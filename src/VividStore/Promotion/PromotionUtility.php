<?php 
namespace Concrete\Package\VividStore\Src\VividStore\Promotion;

use Controller;
use View;
use User;
use Illuminate\Filesystem\Filesystem;

use \Concrete\Package\VividStore\Src\VividStore\Order\Order as StoreOrder;
use \Concrete\Package\VividStore\Src\VividStore\Promotion\PromotionRewardType as StorePromotionRewardType;

class PromotionUtility extends Controller
{
    public function saveReward()
    {
        $user = new User();
        if($user->isLoggedIn()) {
            if ($this->post()) {
                $rewardType = StorePromotionRewardType::getByID($this->post('rewardTypeID'));
                $reward = $rewardType->getController()->addReward($this->post());
                $returnArray = array(
                    'rewardTypeID' => $this->post('rewardTypeID'),
                    'rewardTypeRewardID' => $reward->getID()
                );
                echo json_encode($returnArray);
            }
        }
    }    
}
