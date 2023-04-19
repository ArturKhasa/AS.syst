from fer import Video
from fer import FER
from sys import argv
import os
import sys
import pandas as pd
import json



def faceVideoDetect():
    location_videofile = "IMG_3100_Trim.mp4"
    face_detector = FER(mtcnn=True)
    input_video = Video(location_videofile)
    processing_data = input_video.analyze(face_detector, display=False)
    vid_df = input_video.to_pandas(processing_data)
    res_dict = input_video._to_dict(processing_data)
    with open('face_analyze2.json', 'w') as file:
        json.dump(res_dict, file, indent=4, ensure_ascii=False)

    return res_dict


# name = argv
# Put in the location of the video file that has to be processed
location_videofile = "IMG_4635.mp4"
# location_videofile = name

# Build the Face detection detector
face_detector = FER(mtcnn=True)
# Input the video for processing
input_video = Video(location_videofile)

# The Analyze() function will run analysis on every frame of the input video.
# It will create a rectangular box around every image and show the emotion values next to that.
# Finally, the method will publish a new video that will have a box around the face of the human with live emotion values.
processing_data = input_video.analyze(face_detector, display=False)

# We will now convert the analysed information into a dataframe.
# This will help us import the data as a .CSV file to perform analysis over it later
vid_df = input_video.to_pandas(processing_data)
res_dict = input_video._to_dict(processing_data)
with open('face_analyze2.json', 'w') as file:
    json.dump(res_dict, file, indent=4, ensure_ascii=False)


