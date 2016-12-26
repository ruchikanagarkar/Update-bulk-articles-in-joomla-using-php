# Update-bulk-articles-in-joomla-using-php
This php script helps to update bulk articles in Joomla without content modification. 
There are 2 scripts :
* UpdateAllArticles.php - This updates all articles present in Joomla by their id.
* UpdateMissingAsset.php - Updates those articles whose assets has been broken. This was diagnosed by Missing Assets feature of ACL Manager extension and was stuck in a loop when I tried fixing the articles. Manual method is to open and re-save the articles one by one. But, in case of 1000 articles or more it would be hectic. To avoid this, use this script. 

