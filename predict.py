import face_video_detect
import json
import sys

video_detect = face_video_detect.DetectEmotion()
filename = sys.argv[1]
fps = 3
video_detect.start(filename=filename, fps=fps)
result = video_detect.get_result()
print(json.dumps(result))

# from flask import Flask, request
# app = Flask(__name__)
# @app.route('/predict', methods=['POST'])
# def predict():
#     filename = request.get_json()['filename']
#     fps = request.get_json()['fps']
# video_detect.start(filename=filename, fps=fps)
#     return video_detect.get_result()
#
#
# if __name__ == "__main__":
#     app.run(host='0.0.0.0', port=80)
