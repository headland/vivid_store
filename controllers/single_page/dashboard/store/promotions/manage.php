<?php

namespace Concrete\Package\VividStore\Controller\SinglePage\Dashboard\Store\Promotions;

use \Concrete\Core\Page\Controller\DashboardPageController;

use \Concrete\Package\VividStore\Src\VividStore\Promotion\Promotion as StorePromotion;
use \Concrete\Package\VividStore\Src\VividStore\Promotion\PromotionRewardType as StorePromotionRewardType;
use \Concrete\Package\VividStore\Src\VividStore\Promotion\PromotionRuleType as StorePromotionRuleType;

class Manage extends DashboardPageController
{

    public function view($promotionID=null)
    {
        $this->requireAsset('css', 'vividStoreDashboard');
        $this->requireAsset('javascript', 'vividStoreFunctions');
        if($promotionID){
            $promotion = StorePromotion::getByID($promotionID);
        } else {
            $promotion = new StorePromotion();
        }
        $this->set('rewardTypes',StorePromotionRewardType::getPromotionRewardTypes());
        $this->set('ruleTypes',StorePromotionRuleType::getPromotionRuleTypes());
        $this->set('promotion',$promotion);
        $js = \Concrete\Package\VividStore\Controller::returnHeaderJS();
        $this->addFooterItem($js);
    }
    public function add_reward($rewardTypeID)
    {
        if($this->post()){
            $rewardType = StorePromotionRewardType::getByID($rewardTypeID);
            $rewardType->getController()->addReward($this->post());
        }
    }

}
