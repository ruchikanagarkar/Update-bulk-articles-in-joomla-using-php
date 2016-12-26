<?php
/*
 * Script for updating articles in Joomla with external php file placed in the root directory of Joomla package
*/

if (!defined('_JEXEC')) {
    define( '_JEXEC', 1 );
    define('JPATH_BASE', realpath(dirname(__FILE__)));
    require_once ( JPATH_BASE .'/includes/defines.php' );
    require_once ( JPATH_BASE .'/includes/framework.php' );
    defined('DS') or define('DS', DIRECTORY_SEPARATOR);
}

$app = JFactory::getApplication('site');

$basePath = JPATH_ADMINISTRATOR.'/components/com_content';
require_once $basePath.'/models/article.php';
$config  = array('table_path' => $basePath.'/tables');
$article_model = new ContentModelArticle($config);
$db = JFactory::getDbo();


/*
* Example: 1 is your starting article id and 1000 is ending article id
*/
for($i=1; $i<1000;$i++){
	$query = $db->getQuery(true);
	$query->select('*')->from('#__content')->where('id='.$i.'');
	$update_data = $db->setQuery($query)->loadAssoc();

	if(!$article_model->save($update_data)){
	    echo $err_msg = $article_model->getError();

	}else{
		echo '<p>article updated - '.$i.'</p>';
	}
}

?>
