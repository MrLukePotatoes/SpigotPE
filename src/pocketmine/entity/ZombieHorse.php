<?php
namespace pocketmine\entity;

use pocketmine\item\Item as ItemItem;
use pocketmine\network\mcpe\protocol\AddEntityPacket;
use pocketmine\Player;

class ZombieHorse extends Animal /*implements Rideable*/{
    const NETWORK_ID = 27;

    public $width = 0.75;
    public $height = 1.562;
    public $lenght = 1.5;//TODO
	
	protected $exp_min = 1;
	protected $exp_max = 3;//TODO
	protected $maxHealth = 10;//TODO

    public function initEntity(){
        parent::initEntity();
    }

    public function getName(){
        return "Zombie Horse";
    }

	public function spawnTo(Player $player){
		$pk = new AddEntityPacket();
		$pk->type = self::NETWORK_ID;
		$pk->entityRuntimeId = $this->getId();
		$pk->x = $this->x;
		$pk->y = $this->y;
		$pk->z = $this->z;
		$pk->speedX = $this->motionX;
		$pk->speedY = $this->motionY;
		$pk->speedZ = $this->motionZ;
		$pk->yaw = $this->yaw;
		$pk->pitch = $this->pitch;
		$pk->metadata = $this->dataProperties;
		$player->dataPacket($pk);

		parent::spawnTo($player);
	}

	public function isBaby(){
		return $this->getDataFlag(self::DATA_FLAGS, self::DATA_FLAG_BABY);
	}

    public function getDrops(){
        $drops = [
            ItemItem::get(ItemItem::ROTTEN_FLESH, 0, mt_rand(0, 2))//TODO
        ];

        return $drops;
    }
}
