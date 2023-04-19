from flask import Flask, request
import face_video_detect

app = Flask(__name__)
video_detect = face_video_detect.DetectEmotion()


@app.route('/predict', methods=['POST'])
def predict():
    filename = request.get_json()['filename']
    fps = request.get_json()['fps']
    video_detect.start(filename=filename, fps=fps)
    return video_detect.get_result()


if __name__ == "__main__":
    app.run(host='0.0.0.0', port=80)