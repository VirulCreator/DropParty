<?php

namespace DropParty;

use DropParty\tasks\DropPartyTask;
use pocketmine\item\Item;
use pocketmine\math\Vector3;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

    /** @var self */
	private static $instance;
	/** @var array */
	private $cfg;

	public function onLoad(): void{
		self::$instance = $this;
		$this->saveDefaultConfig();
		$this->cfg = $this->getConfig()->getAll();
	}

	public function onEnable(): void{
        $this->getScheduler()->scheduleRepeatingTask(new DropPartyTask(), 20);
    }

    public static function get(): self{
		return self::$instance;
	}

    /**
     * @return Vector3
     */
    public function getLocation(): Vector3{
        $i = explode(",", $this->cfg["coordinates"]);
        return new Vector3(intval($i[0]), intval($i[1]), intval($i[2]));
    }

    /**
     * @return array
     */
    public function getCfg(): array{
        return $this->cfg;
    }

    public function getId($item): int{
        $i = explode(":", strval($item));
        if(isset($i[0])){
            return intval($i[0]);
        }else{
            return 1;
        }
    }

    public function getAmount($item): int{
        $i = explode(":", strval($item));
        if(isset($i[1])){
            return intval($i[1]);
        }else{
            return 1;
        }
    }

    public function getRandomItem(): Item{
        $rand = array_rand($this->cfg["items"]);
        $id = $this->cfg["items"][$rand];
        $amount = $this->getAmount($id);
        return Item::get($this->getId($id), 0, $amount);
    }
}