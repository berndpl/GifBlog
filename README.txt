:: ANIMATION FLOOR 0.1 - simple animated gif gallery
              

FEATURES

* created for showing animated gifs only
* rename + upload is every thing needed to publish
* date + title is directly parsed from image filenames
* quad2gif.sh skript to batch create animated gifs
* basic RSS feed
                   

TO COME

* automation for the uploading process
* porting to cakephp
* improve RSS feed
                                          

CREDITS

* FeedCreator class v1.7.2, Kai Blankenhorn, www.bitfolge.de
* Imagemagick, http://www.imagemagick.org/
               

WHAT IS ANIMATION FLOOR?

it's meant to be a simple photo-blog system for animated gifs. one page, showing a bunch of GIFs in a chronological order with title-overlays. that's it.


HOW DO YOU MAKE THESE ANIMATIONS?

all photos are taken with an iphone and the amazing quadcamera app. to bulk convert quadcamera jpgs to to animated gifs I use my QUAD2GIF skript (/quad2gif.sh). however, for single conversions you could also use quadanimator. (http://labs.artandmobile.com/quadanimator/)


HOW DOES IT WORK?
                                     floor
in order to post a photo, you just upload it to the pub/ directory and .... well, that's it. there is no backend, database or cms. just PHP and IMAGEMAGICK. the only thing to remember is to name your files according to the scheme: "090813_nicetitle.gif" - this will put an image with the timemark "13.08.09" and the title "nicetitle" on your ANIMATION FLOOR. if you don't want any title use the keyword "blank", e.g. "090813_blank.gif". there is even a converterscript for new photos, so you don't have to neccessarily use the quadanimator.


WHY DON'T YOU JUST USE SYSTEM XY? IT'S WAY COOLER!

either because i didn't know that it exists or because i thought that it is too bloated for this purpose. but hey if you know cool alternatives, please tell me about them!

                                                      
:: QUAD2GIF 0.1 - unix batch script for bulk conversions of quadcamera images to animated gifs    


WHAT IS IT?                

it's a simple unix batch script to convert folders full of quadcamera images into animated gifs with one command. to run it you need imagemagick installed on your system, it will do the imageprocessing part. on mac os x you can get it with the darwin ports (it's a repository of unix ports for mac os x. great stuff.). put it into the folder with you quadcamera images locally or on your server and run it by typing "./quad2gif". have fun!

CONTACT: bernd@plontsch.de