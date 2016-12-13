<?php
/*
 * Script for updating articles to fix assets table without opening and re-saving articles.
 * This works if you are using ACL manager extension to fix the assets table
*/
if (!defined('_JEXEC')) {
    define( '_JEXEC', 1 );
    define('JPATH_BASE', realpath(dirname(__FILE__)));
    require_once ( JPATH_BASE .'/includes/defines.php' );
    require_once ( JPATH_BASE .'/includes/framework.php' );
    defined('DS') or define('DS', DIRECTORY_SEPARATOR);
}

$app = JFactory::getApplication('site');
$db = JFactory::getDbo();


$basePath = JPATH_ADMINISTRATOR.'/components/com_content';
require_once $basePath.'/models/article.php';
$article_model =  JModelLegacy::getInstance('Article','ContentModel');

require_once JPATH_ADMINISTRATOR.'/components/com_aclmanager/models/diagnostic.php';
$acl_model =  JModelLegacy::getInstance('Diagnostic','AclmanagerModel');
$missingAssets = $acl_model->getMissingAssets();

/*
 * @missingAssets : returns array of issues present in asset table
 *
*/
foreach ($missingAssets as $key => $value) {
	//to check and update only articles. The array might contain type of category and module as well
	if($value->type == 'article'){
		$query = $db->getQuery(true);
		$query->select('*')->from('#__content')->where('id='.$value->id.'');
		$update_data = $db->setQuery($query)->loadAssoc();
		$article_model->save($update_data);
		echo '<p>article updated - '.$value->id.'</p>';
	}
}


?>