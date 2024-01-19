<?php

declare(strict_types=1);

namespace Nay\AntiVoid;

use pocketmine\math\Vector3;
use pocketmine\event\entity\EntityDamageEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\world\World;

class Main extends PluginBase implements Listener{

    /** @var string[] */
    private array $worlds = []; //les noms des mondes où les dégâts de chute et de vide sont désactivés

    /** @var bool */
    private bool $voidTp = false; //si vrai, les joueurs qui tombent dans le vide seront téléportés à des coordonnées configurables

    /** @var float */
    private float $tpX = 0.0; //la coordonnée X de la téléportation

    /** @var float */
    private float $tpY = 0.0; //la coordonnée Y de la téléportation

    /** @var float */
    private float $tpZ = 0.0; //la coordonnée Z de la téléportation

    /** @var World|null */
    private ?World $tpWorld = null; //le monde de la téléportation, null si non configuré

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        $this->worlds = $this->getConfig()->get("worlds");
        $this->voidTp = $this->getConfig()->get("void-tp");
        $this->tpX = $this->getConfig()->get("tp-x");
        $this->tpY = $this->getConfig()->get("tp-y");
        $this->tpZ = $this->getConfig()->get("tp-z");
        $tpWorldName = $this->getConfig()->get("tp-world");
        if($tpWorldName !== ""){
            $this->tpWorld = $this->getServer()->getWorldManager()->getWorldByName($tpWorldName);
            if($this->tpWorld === null){
               $this->getLogger()->warning("Le monde de téléportation $tpWorldName n'existe pas ou n'est pas chargé");
            }
        }
    }

    public function onEntityDamage(EntityDamageEvent $event) : void{
        $entity = $event->getEntity();
        if($entity instanceof Player and in_array($entity->getWorld()->getFolderName(), $this->worlds, true)){
            $cause = $event->getCause();
            if($cause === EntityDamageEvent::CAUSE_FALL){
                $event->cancel(); //annuler les dégâts de chute
            }elseif($cause === EntityDamageEvent::CAUSE_VOID){
                $event->cancel(); //annuler les dégâts de vide
                if($this->voidTp and $this->tpWorld !== null){
                    //téléporter le joueur aux coordonnées configurées
                    $entity->teleport($this->tpWorld->getSafeSpawn(new Vector3($this->tpX, $this->tpY, $this->tpZ)));
                }
            }
        }
    }
}
