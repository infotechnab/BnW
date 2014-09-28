#BnW
A complete Open CMS

=====================================================================================================================

###FILES:
=====================================================================================================================
Template_meta_data.php

This file is to store information about the template meta data. All the info about template is stored on this file. This file is located on template folder. 

viewMenuHelper_helper

This helper file is located inside helper folder in application. This file is to show navigation items on view according to the database.

myHelper_helper

This is a helper file. This file mainly deals with fetching the navigation items on dashboard. According to the user selected menu this file fetches navigation items associated with that selected menu and these navigation items are shown on their own hierarchial order.

Change in gadget database.

One field called 'defaultGadget' is added to gadgets table in database. This addition was necessary for default gadget because it is necessary for controller to know the name of the default gadget.

Spectrum.css and specturm.js

Add this two files css and js file which is jquery plugin of color chooser. I used it to add option on default gadget about what color the title of post to be displayed.

Added method in conroller/gadgets.php and model/model1.php

Added defaultGadgetUpdate method and textBoxUpdate method in gadgets.php controller which is used to update the gadget of default recent post gadget and textbox gadget respectivley. And added defaultGadgetUpdate and textBoxUpdate method in model1.php for updating recent post gadget and textbox gadget respectively.

Added single field in database's gadgets table

Added textBox field in gadget table for specifying the inserted gadget is textbox and working with textbox according to it.


###Functions:
=====================================================================================================================
validate_credentials

In Validate_credentials function in login controller session time is set 1 hour if user didn't checked the stay logged in checkbox and 7 days if checked the checkbox.


###Chnage Log
======================================================================================================================
In current working version 

In case of creating custom link, there was lack of facility to make custom link visible under other main link, now custom link could be listed as parent or as child of other parent links.
Newsletter subscription and contact list facility is added to both of template and dashboard. Now from dashboard through the link subscription, news letter subscribers could be viewed and managed and from the same navigation the contact list as well as feed backs could be viewed and managed.



##BnW 1.1 
Working on. 
Changes: 




BnW1.0
All the features with simple view is designed. 

Changes: First public release 




