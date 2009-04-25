<?php


abstract class BaseMember extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $id;


	
	protected $name;


	
	protected $is_active;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $collAuthenticationLoginIds;

	
	protected $lastAuthenticationLoginIdCriteria = null;

	
	protected $collApplicationSettingss;

	
	protected $lastApplicationSettingsCriteria = null;

	
	protected $collMemberApplicationss;

	
	protected $lastMemberApplicationsCriteria = null;

	
	protected $collMemberProfiles;

	
	protected $lastMemberProfileCriteria = null;

	
	protected $collFriendPresRelatedByMemberIdTo;

	
	protected $lastFriendPreRelatedByMemberIdToCriteria = null;

	
	protected $collFriendPresRelatedByMemberIdFrom;

	
	protected $lastFriendPreRelatedByMemberIdFromCriteria = null;

	
	protected $collFriendsRelatedByMemberIdTo;

	
	protected $lastFriendRelatedByMemberIdToCriteria = null;

	
	protected $collFriendsRelatedByMemberIdFrom;

	
	protected $lastFriendRelatedByMemberIdFromCriteria = null;

	
	protected $collCommunityMembers;

	
	protected $lastCommunityMemberCriteria = null;

	
	protected $collMemberConfigs;

	
	protected $lastMemberConfigCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getId()
	{

		return $this->id;
	}

	
	public function getName()
	{

		return $this->name;
	}

	
	public function getIsActive()
	{

		return $this->is_active;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = MemberPeer::ID;
		}

	} 
	
	public function setName($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->name !== $v) {
			$this->name = $v;
			$this->modifiedColumns[] = MemberPeer::NAME;
		}

	} 
	
	public function setIsActive($v)
	{

		if ($this->is_active !== $v) {
			$this->is_active = $v;
			$this->modifiedColumns[] = MemberPeer::IS_ACTIVE;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = MemberPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = MemberPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->id = $rs->getInt($startcol + 0);

			$this->name = $rs->getString($startcol + 1);

			$this->is_active = $rs->getBoolean($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->updated_at = $rs->getTimestamp($startcol + 4, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Member object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MemberPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MemberPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(MemberPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(MemberPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MemberPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MemberPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MemberPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collAuthenticationLoginIds !== null) {
				foreach($this->collAuthenticationLoginIds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collApplicationSettingss !== null) {
				foreach($this->collApplicationSettingss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMemberApplicationss !== null) {
				foreach($this->collMemberApplicationss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMemberProfiles !== null) {
				foreach($this->collMemberProfiles as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendPresRelatedByMemberIdTo !== null) {
				foreach($this->collFriendPresRelatedByMemberIdTo as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendPresRelatedByMemberIdFrom !== null) {
				foreach($this->collFriendPresRelatedByMemberIdFrom as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendsRelatedByMemberIdTo !== null) {
				foreach($this->collFriendsRelatedByMemberIdTo as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFriendsRelatedByMemberIdFrom !== null) {
				foreach($this->collFriendsRelatedByMemberIdFrom as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collCommunityMembers !== null) {
				foreach($this->collCommunityMembers as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMemberConfigs !== null) {
				foreach($this->collMemberConfigs as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = MemberPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collAuthenticationLoginIds !== null) {
					foreach($this->collAuthenticationLoginIds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collApplicationSettingss !== null) {
					foreach($this->collApplicationSettingss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMemberApplicationss !== null) {
					foreach($this->collMemberApplicationss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMemberProfiles !== null) {
					foreach($this->collMemberProfiles as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendPresRelatedByMemberIdTo !== null) {
					foreach($this->collFriendPresRelatedByMemberIdTo as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendPresRelatedByMemberIdFrom !== null) {
					foreach($this->collFriendPresRelatedByMemberIdFrom as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendsRelatedByMemberIdTo !== null) {
					foreach($this->collFriendsRelatedByMemberIdTo as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFriendsRelatedByMemberIdFrom !== null) {
					foreach($this->collFriendsRelatedByMemberIdFrom as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collCommunityMembers !== null) {
					foreach($this->collCommunityMembers as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMemberConfigs !== null) {
					foreach($this->collMemberConfigs as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getName();
				break;
			case 2:
				return $this->getIsActive();
				break;
			case 3:
				return $this->getCreatedAt();
				break;
			case 4:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MemberPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getId(),
			$keys[1] => $this->getName(),
			$keys[2] => $this->getIsActive(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MemberPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setName($value);
				break;
			case 2:
				$this->setIsActive($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MemberPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setName($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIsActive($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUpdatedAt($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MemberPeer::DATABASE_NAME);

		if ($this->isColumnModified(MemberPeer::ID)) $criteria->add(MemberPeer::ID, $this->id);
		if ($this->isColumnModified(MemberPeer::NAME)) $criteria->add(MemberPeer::NAME, $this->name);
		if ($this->isColumnModified(MemberPeer::IS_ACTIVE)) $criteria->add(MemberPeer::IS_ACTIVE, $this->is_active);
		if ($this->isColumnModified(MemberPeer::CREATED_AT)) $criteria->add(MemberPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(MemberPeer::UPDATED_AT)) $criteria->add(MemberPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MemberPeer::DATABASE_NAME);

		$criteria->add(MemberPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setName($this->name);

		$copyObj->setIsActive($this->is_active);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getAuthenticationLoginIds() as $relObj) {
				$copyObj->addAuthenticationLoginId($relObj->copy($deepCopy));
			}

			foreach($this->getApplicationSettingss() as $relObj) {
				$copyObj->addApplicationSettings($relObj->copy($deepCopy));
			}

			foreach($this->getMemberApplicationss() as $relObj) {
				$copyObj->addMemberApplications($relObj->copy($deepCopy));
			}

			foreach($this->getMemberProfiles() as $relObj) {
				$copyObj->addMemberProfile($relObj->copy($deepCopy));
			}

			foreach($this->getFriendPresRelatedByMemberIdTo() as $relObj) {
				$copyObj->addFriendPreRelatedByMemberIdTo($relObj->copy($deepCopy));
			}

			foreach($this->getFriendPresRelatedByMemberIdFrom() as $relObj) {
				$copyObj->addFriendPreRelatedByMemberIdFrom($relObj->copy($deepCopy));
			}

			foreach($this->getFriendsRelatedByMemberIdTo() as $relObj) {
				$copyObj->addFriendRelatedByMemberIdTo($relObj->copy($deepCopy));
			}

			foreach($this->getFriendsRelatedByMemberIdFrom() as $relObj) {
				$copyObj->addFriendRelatedByMemberIdFrom($relObj->copy($deepCopy));
			}

			foreach($this->getCommunityMembers() as $relObj) {
				$copyObj->addCommunityMember($relObj->copy($deepCopy));
			}

			foreach($this->getMemberConfigs() as $relObj) {
				$copyObj->addMemberConfig($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new MemberPeer();
		}
		return self::$peer;
	}

	
	public function initAuthenticationLoginIds()
	{
		if ($this->collAuthenticationLoginIds === null) {
			$this->collAuthenticationLoginIds = array();
		}
	}

	
	public function getAuthenticationLoginIds($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collAuthenticationLoginIds === null) {
			if ($this->isNew()) {
			   $this->collAuthenticationLoginIds = array();
			} else {

				$criteria->add(AuthenticationLoginIdPeer::MEMBER_ID, $this->getId());

				AuthenticationLoginIdPeer::addSelectColumns($criteria);
				$this->collAuthenticationLoginIds = AuthenticationLoginIdPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(AuthenticationLoginIdPeer::MEMBER_ID, $this->getId());

				AuthenticationLoginIdPeer::addSelectColumns($criteria);
				if (!isset($this->lastAuthenticationLoginIdCriteria) || !$this->lastAuthenticationLoginIdCriteria->equals($criteria)) {
					$this->collAuthenticationLoginIds = AuthenticationLoginIdPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastAuthenticationLoginIdCriteria = $criteria;
		return $this->collAuthenticationLoginIds;
	}

	
	public function countAuthenticationLoginIds($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(AuthenticationLoginIdPeer::MEMBER_ID, $this->getId());

		return AuthenticationLoginIdPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addAuthenticationLoginId(AuthenticationLoginId $l)
	{
		$this->collAuthenticationLoginIds[] = $l;
		$l->setMember($this);
	}

	
	public function initApplicationSettingss()
	{
		if ($this->collApplicationSettingss === null) {
			$this->collApplicationSettingss = array();
		}
	}

	
	public function getApplicationSettingss($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplicationSettingss === null) {
			if ($this->isNew()) {
			   $this->collApplicationSettingss = array();
			} else {

				$criteria->add(ApplicationSettingsPeer::MEMBER_ID, $this->getId());

				ApplicationSettingsPeer::addSelectColumns($criteria);
				$this->collApplicationSettingss = ApplicationSettingsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ApplicationSettingsPeer::MEMBER_ID, $this->getId());

				ApplicationSettingsPeer::addSelectColumns($criteria);
				if (!isset($this->lastApplicationSettingsCriteria) || !$this->lastApplicationSettingsCriteria->equals($criteria)) {
					$this->collApplicationSettingss = ApplicationSettingsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastApplicationSettingsCriteria = $criteria;
		return $this->collApplicationSettingss;
	}

	
	public function countApplicationSettingss($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ApplicationSettingsPeer::MEMBER_ID, $this->getId());

		return ApplicationSettingsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addApplicationSettings(ApplicationSettings $l)
	{
		$this->collApplicationSettingss[] = $l;
		$l->setMember($this);
	}


	
	public function getApplicationSettingssJoinApplications($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collApplicationSettingss === null) {
			if ($this->isNew()) {
				$this->collApplicationSettingss = array();
			} else {

				$criteria->add(ApplicationSettingsPeer::MEMBER_ID, $this->getId());

				$this->collApplicationSettingss = ApplicationSettingsPeer::doSelectJoinApplications($criteria, $con);
			}
		} else {
									
			$criteria->add(ApplicationSettingsPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastApplicationSettingsCriteria) || !$this->lastApplicationSettingsCriteria->equals($criteria)) {
				$this->collApplicationSettingss = ApplicationSettingsPeer::doSelectJoinApplications($criteria, $con);
			}
		}
		$this->lastApplicationSettingsCriteria = $criteria;

		return $this->collApplicationSettingss;
	}

	
	public function initMemberApplicationss()
	{
		if ($this->collMemberApplicationss === null) {
			$this->collMemberApplicationss = array();
		}
	}

	
	public function getMemberApplicationss($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMemberApplicationss === null) {
			if ($this->isNew()) {
			   $this->collMemberApplicationss = array();
			} else {

				$criteria->add(MemberApplicationsPeer::MEMBER_ID, $this->getId());

				MemberApplicationsPeer::addSelectColumns($criteria);
				$this->collMemberApplicationss = MemberApplicationsPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MemberApplicationsPeer::MEMBER_ID, $this->getId());

				MemberApplicationsPeer::addSelectColumns($criteria);
				if (!isset($this->lastMemberApplicationsCriteria) || !$this->lastMemberApplicationsCriteria->equals($criteria)) {
					$this->collMemberApplicationss = MemberApplicationsPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMemberApplicationsCriteria = $criteria;
		return $this->collMemberApplicationss;
	}

	
	public function countMemberApplicationss($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MemberApplicationsPeer::MEMBER_ID, $this->getId());

		return MemberApplicationsPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMemberApplications(MemberApplications $l)
	{
		$this->collMemberApplicationss[] = $l;
		$l->setMember($this);
	}


	
	public function getMemberApplicationssJoinApplications($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMemberApplicationss === null) {
			if ($this->isNew()) {
				$this->collMemberApplicationss = array();
			} else {

				$criteria->add(MemberApplicationsPeer::MEMBER_ID, $this->getId());

				$this->collMemberApplicationss = MemberApplicationsPeer::doSelectJoinApplications($criteria, $con);
			}
		} else {
									
			$criteria->add(MemberApplicationsPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastMemberApplicationsCriteria) || !$this->lastMemberApplicationsCriteria->equals($criteria)) {
				$this->collMemberApplicationss = MemberApplicationsPeer::doSelectJoinApplications($criteria, $con);
			}
		}
		$this->lastMemberApplicationsCriteria = $criteria;

		return $this->collMemberApplicationss;
	}

	
	public function initMemberProfiles()
	{
		if ($this->collMemberProfiles === null) {
			$this->collMemberProfiles = array();
		}
	}

	
	public function getMemberProfiles($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMemberProfiles === null) {
			if ($this->isNew()) {
			   $this->collMemberProfiles = array();
			} else {

				$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

				MemberProfilePeer::addSelectColumns($criteria);
				$this->collMemberProfiles = MemberProfilePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

				MemberProfilePeer::addSelectColumns($criteria);
				if (!isset($this->lastMemberProfileCriteria) || !$this->lastMemberProfileCriteria->equals($criteria)) {
					$this->collMemberProfiles = MemberProfilePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMemberProfileCriteria = $criteria;
		return $this->collMemberProfiles;
	}

	
	public function countMemberProfiles($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

		return MemberProfilePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMemberProfile(MemberProfile $l)
	{
		$this->collMemberProfiles[] = $l;
		$l->setMember($this);
	}


	
	public function getMemberProfilesJoinProfile($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMemberProfiles === null) {
			if ($this->isNew()) {
				$this->collMemberProfiles = array();
			} else {

				$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

				$this->collMemberProfiles = MemberProfilePeer::doSelectJoinProfile($criteria, $con);
			}
		} else {
									
			$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastMemberProfileCriteria) || !$this->lastMemberProfileCriteria->equals($criteria)) {
				$this->collMemberProfiles = MemberProfilePeer::doSelectJoinProfile($criteria, $con);
			}
		}
		$this->lastMemberProfileCriteria = $criteria;

		return $this->collMemberProfiles;
	}


	
	public function getMemberProfilesJoinProfileOption($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMemberProfiles === null) {
			if ($this->isNew()) {
				$this->collMemberProfiles = array();
			} else {

				$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

				$this->collMemberProfiles = MemberProfilePeer::doSelectJoinProfileOption($criteria, $con);
			}
		} else {
									
			$criteria->add(MemberProfilePeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastMemberProfileCriteria) || !$this->lastMemberProfileCriteria->equals($criteria)) {
				$this->collMemberProfiles = MemberProfilePeer::doSelectJoinProfileOption($criteria, $con);
			}
		}
		$this->lastMemberProfileCriteria = $criteria;

		return $this->collMemberProfiles;
	}

	
	public function initFriendPresRelatedByMemberIdTo()
	{
		if ($this->collFriendPresRelatedByMemberIdTo === null) {
			$this->collFriendPresRelatedByMemberIdTo = array();
		}
	}

	
	public function getFriendPresRelatedByMemberIdTo($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendPresRelatedByMemberIdTo === null) {
			if ($this->isNew()) {
			   $this->collFriendPresRelatedByMemberIdTo = array();
			} else {

				$criteria->add(FriendPrePeer::MEMBER_ID_TO, $this->getId());

				FriendPrePeer::addSelectColumns($criteria);
				$this->collFriendPresRelatedByMemberIdTo = FriendPrePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendPrePeer::MEMBER_ID_TO, $this->getId());

				FriendPrePeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendPreRelatedByMemberIdToCriteria) || !$this->lastFriendPreRelatedByMemberIdToCriteria->equals($criteria)) {
					$this->collFriendPresRelatedByMemberIdTo = FriendPrePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendPreRelatedByMemberIdToCriteria = $criteria;
		return $this->collFriendPresRelatedByMemberIdTo;
	}

	
	public function countFriendPresRelatedByMemberIdTo($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendPrePeer::MEMBER_ID_TO, $this->getId());

		return FriendPrePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendPreRelatedByMemberIdTo(FriendPre $l)
	{
		$this->collFriendPresRelatedByMemberIdTo[] = $l;
		$l->setMemberRelatedByMemberIdTo($this);
	}

	
	public function initFriendPresRelatedByMemberIdFrom()
	{
		if ($this->collFriendPresRelatedByMemberIdFrom === null) {
			$this->collFriendPresRelatedByMemberIdFrom = array();
		}
	}

	
	public function getFriendPresRelatedByMemberIdFrom($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendPresRelatedByMemberIdFrom === null) {
			if ($this->isNew()) {
			   $this->collFriendPresRelatedByMemberIdFrom = array();
			} else {

				$criteria->add(FriendPrePeer::MEMBER_ID_FROM, $this->getId());

				FriendPrePeer::addSelectColumns($criteria);
				$this->collFriendPresRelatedByMemberIdFrom = FriendPrePeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendPrePeer::MEMBER_ID_FROM, $this->getId());

				FriendPrePeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendPreRelatedByMemberIdFromCriteria) || !$this->lastFriendPreRelatedByMemberIdFromCriteria->equals($criteria)) {
					$this->collFriendPresRelatedByMemberIdFrom = FriendPrePeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendPreRelatedByMemberIdFromCriteria = $criteria;
		return $this->collFriendPresRelatedByMemberIdFrom;
	}

	
	public function countFriendPresRelatedByMemberIdFrom($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendPrePeer::MEMBER_ID_FROM, $this->getId());

		return FriendPrePeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendPreRelatedByMemberIdFrom(FriendPre $l)
	{
		$this->collFriendPresRelatedByMemberIdFrom[] = $l;
		$l->setMemberRelatedByMemberIdFrom($this);
	}

	
	public function initFriendsRelatedByMemberIdTo()
	{
		if ($this->collFriendsRelatedByMemberIdTo === null) {
			$this->collFriendsRelatedByMemberIdTo = array();
		}
	}

	
	public function getFriendsRelatedByMemberIdTo($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendsRelatedByMemberIdTo === null) {
			if ($this->isNew()) {
			   $this->collFriendsRelatedByMemberIdTo = array();
			} else {

				$criteria->add(FriendPeer::MEMBER_ID_TO, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				$this->collFriendsRelatedByMemberIdTo = FriendPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendPeer::MEMBER_ID_TO, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendRelatedByMemberIdToCriteria) || !$this->lastFriendRelatedByMemberIdToCriteria->equals($criteria)) {
					$this->collFriendsRelatedByMemberIdTo = FriendPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendRelatedByMemberIdToCriteria = $criteria;
		return $this->collFriendsRelatedByMemberIdTo;
	}

	
	public function countFriendsRelatedByMemberIdTo($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendPeer::MEMBER_ID_TO, $this->getId());

		return FriendPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendRelatedByMemberIdTo(Friend $l)
	{
		$this->collFriendsRelatedByMemberIdTo[] = $l;
		$l->setMemberRelatedByMemberIdTo($this);
	}

	
	public function initFriendsRelatedByMemberIdFrom()
	{
		if ($this->collFriendsRelatedByMemberIdFrom === null) {
			$this->collFriendsRelatedByMemberIdFrom = array();
		}
	}

	
	public function getFriendsRelatedByMemberIdFrom($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFriendsRelatedByMemberIdFrom === null) {
			if ($this->isNew()) {
			   $this->collFriendsRelatedByMemberIdFrom = array();
			} else {

				$criteria->add(FriendPeer::MEMBER_ID_FROM, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				$this->collFriendsRelatedByMemberIdFrom = FriendPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FriendPeer::MEMBER_ID_FROM, $this->getId());

				FriendPeer::addSelectColumns($criteria);
				if (!isset($this->lastFriendRelatedByMemberIdFromCriteria) || !$this->lastFriendRelatedByMemberIdFromCriteria->equals($criteria)) {
					$this->collFriendsRelatedByMemberIdFrom = FriendPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFriendRelatedByMemberIdFromCriteria = $criteria;
		return $this->collFriendsRelatedByMemberIdFrom;
	}

	
	public function countFriendsRelatedByMemberIdFrom($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FriendPeer::MEMBER_ID_FROM, $this->getId());

		return FriendPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFriendRelatedByMemberIdFrom(Friend $l)
	{
		$this->collFriendsRelatedByMemberIdFrom[] = $l;
		$l->setMemberRelatedByMemberIdFrom($this);
	}

	
	public function initCommunityMembers()
	{
		if ($this->collCommunityMembers === null) {
			$this->collCommunityMembers = array();
		}
	}

	
	public function getCommunityMembers($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCommunityMembers === null) {
			if ($this->isNew()) {
			   $this->collCommunityMembers = array();
			} else {

				$criteria->add(CommunityMemberPeer::MEMBER_ID, $this->getId());

				CommunityMemberPeer::addSelectColumns($criteria);
				$this->collCommunityMembers = CommunityMemberPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(CommunityMemberPeer::MEMBER_ID, $this->getId());

				CommunityMemberPeer::addSelectColumns($criteria);
				if (!isset($this->lastCommunityMemberCriteria) || !$this->lastCommunityMemberCriteria->equals($criteria)) {
					$this->collCommunityMembers = CommunityMemberPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastCommunityMemberCriteria = $criteria;
		return $this->collCommunityMembers;
	}

	
	public function countCommunityMembers($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(CommunityMemberPeer::MEMBER_ID, $this->getId());

		return CommunityMemberPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addCommunityMember(CommunityMember $l)
	{
		$this->collCommunityMembers[] = $l;
		$l->setMember($this);
	}


	
	public function getCommunityMembersJoinCommunity($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collCommunityMembers === null) {
			if ($this->isNew()) {
				$this->collCommunityMembers = array();
			} else {

				$criteria->add(CommunityMemberPeer::MEMBER_ID, $this->getId());

				$this->collCommunityMembers = CommunityMemberPeer::doSelectJoinCommunity($criteria, $con);
			}
		} else {
									
			$criteria->add(CommunityMemberPeer::MEMBER_ID, $this->getId());

			if (!isset($this->lastCommunityMemberCriteria) || !$this->lastCommunityMemberCriteria->equals($criteria)) {
				$this->collCommunityMembers = CommunityMemberPeer::doSelectJoinCommunity($criteria, $con);
			}
		}
		$this->lastCommunityMemberCriteria = $criteria;

		return $this->collCommunityMembers;
	}

	
	public function initMemberConfigs()
	{
		if ($this->collMemberConfigs === null) {
			$this->collMemberConfigs = array();
		}
	}

	
	public function getMemberConfigs($criteria = null, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMemberConfigs === null) {
			if ($this->isNew()) {
			   $this->collMemberConfigs = array();
			} else {

				$criteria->add(MemberConfigPeer::MEMBER_ID, $this->getId());

				MemberConfigPeer::addSelectColumns($criteria);
				$this->collMemberConfigs = MemberConfigPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MemberConfigPeer::MEMBER_ID, $this->getId());

				MemberConfigPeer::addSelectColumns($criteria);
				if (!isset($this->lastMemberConfigCriteria) || !$this->lastMemberConfigCriteria->equals($criteria)) {
					$this->collMemberConfigs = MemberConfigPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMemberConfigCriteria = $criteria;
		return $this->collMemberConfigs;
	}

	
	public function countMemberConfigs($criteria = null, $distinct = false, $con = null)
	{
				if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MemberConfigPeer::MEMBER_ID, $this->getId());

		return MemberConfigPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMemberConfig(MemberConfig $l)
	{
		$this->collMemberConfigs[] = $l;
		$l->setMember($this);
	}

} 