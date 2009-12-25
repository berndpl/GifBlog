#!/bin/bash
#quad2gif 0.1 by Bernd Plontsch 
#note: imagemagick is required to run this script!
#for everybody who needs a simple script to convert a lot of quadcamera photos into animated gifs
#visit http://blog.plontsch.de or leave me a message at bernd@plontsch.de

#CONFIG

NUM_FRAMES=4
DELAY=25

OFFSET_XOFF_0=4
OFFSET_YOFF_0=4
OFFSET_XOFF_1=304
OFFSET_YOFF_1=4
OFFSET_XOFF_2=4
OFFSET_YOFF_2=404
OFFSET_XOFF_3=304
OFFSET_YOFF_3=404

SOURCE_WIDTH=293
SOURCE_HEIGHT=391

TARGET_WIDTH=150
TARGET_HEIGHT=201

#FUNCTIONS

function crop {
	echo "[CROPPING...]"
	Z=0
	while [ $Z -lt $NUM_FRAMES ]; do
		let OX=OFFSET_XOFF_$Z;
		let OY=OFFSET_YOFF_$Z;
		TARGET_IMG="${Z}_${1}";
				CMD="convert -crop ${SOURCE_WIDTH}x${SOURCE_HEIGHT}+${OX}+${OY} $1 $TARGET_IMG"
				echo -e "\t $CMD"
				$CMD
		let Z=Z+1
	done
}

function convert2gif {
	echo "[CONVERTING...]"
	Z=0
	while [ $Z -lt $NUM_FRAMES ]; do
		SOURCE_IMG="${Z}_${1}"
		TARGET_IMG=${SOURCE_IMG%".jpg"}.gif
			CMD="convert $SOURCE_IMG $TARGET_IMG"
		 	echo -e "\t $CMD"
		 	$CMD
		let Z=Z+1
	done
}

function animate {
	echo "[ANIMATING...]"
	SOURCEJPG_IMG="${1}" #JPG without frame num
	SOURCEGIF_IMG=${SOURCEJPG_IMG%".jpg"}.gif #GIF without frame num
	TARGET_IMG=${SOURCEJPG_IMG%".jpg"}.gif #target name, animated GIF
		CMD="convert -delay $DELAY -loop 0 *_$SOURCEGIF_IMG $TARGET_IMG"
		echo -e "\t $CMD"
		$CMD
}

function resize {
	echo "[RESIZING...]"
	SOURCEJPG_IMG="${1}"
	SOURCEGIF_IMG=${SOURCEJPG_IMG%".jpg"}.gif #target name, animated GIF
	TARGET_IMG=$SOURCEGIF_IMG #overwrite existing bigger image
		CMD="convert $SOURCEGIF_IMG -resize ${TARGET_WIDTH}x${TARGET_HEIGHT} $TARGET_IMG"
		echo -e "\t $CMD"
		$CMD
}

function clean {
	echo "[CLEANING UP...]"
	Z=0
	while [ $Z -lt $NUM_FRAMES ]; do
		SOURCEJPG_IMG="${Z}_${1}"
		SOURCEGIF_IMG=${SOURCEJPG_IMG%".jpg"}.gif
			CMD="rm $SOURCEJPG_IMG $SOURCEGIF_IMG"
		 	echo -e "\t $CMD"
		 	$CMD
		let Z=Z+1
	done
}

function process {
	crop $1
	convert2gif $1
	animate $1
	resize $1
	clean $1
}

#LOOP

if [ "$1" = "" ]; then
	echo "---------------------------------"
	echo -e "Hi $USER, now I will turn all your quadcamera images in this folder into animated gifs, yay!"
	echo -e "Note: If there are non-quadcamera images it won't work with them (I am no magician, you know...) - at least not without tweaking the config parameters *wink*. Ok, let's go!"
	echo -e "---------------------------------\n"	
	for file in `ls *.jpg *.JPG`; do
		echo "[PROCESSING...] $file"
		process $file
		echo -e "[...DONE!]\n"
	done
fi

