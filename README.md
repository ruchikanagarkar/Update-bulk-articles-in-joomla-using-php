# Update-bulk-articles-in-joomla-using-php
This php script helps to update bulk articles in Joomla without content modification. 
There are 2 scripts :
* UpdateAllArticles.php - This updates all articles present in Joomla by their id.
* UpdateMissingAsset.php - Updates those articles whose assets has been broken. This was diagnosed by Missing Assets feature of ACL Manager extension and was stuck in a loop when I tried fixing the articles. Manual method is to open and re-save the articles one by one. But, in case of 1000 articles or more it would be hectic. To avoid this, use this script. 

Note:- You might get an error:
> 0 - Call to a member function reorder() on boolean . 
This occurs on of line number 702 of `administrator/components/com_content/models/article.php`. To avoid this, you can temporarily modify line 602 in save method of the model -  
```php 
if (isset($data['featured']))
```
 to 
 ```php
 if (!empty($data['featured']))
 ```
 Then run the script and later undo the code since it is a core file.

