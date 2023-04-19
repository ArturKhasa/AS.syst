from fer import Video
from fer import FER
import json


class DetectEmotion(object):
    detector = FER(mtcnn=True)
    filename: str
    dir: str
    raw_data: list
    video: object

    def start(self, filename, fps):
        self.filename = filename
        # self.dir = self.filename.partition('.')[0]
        self.dir = "/".join(filename.split('/')[:-1])
        self.video = Video(self.filename, self.dir)
        self.raw_data = self.video.analyze(self.detector, save_fps=fps, zip_images=False)

    def convert_to_json(self):
        res_dict = self.video._to_dict(self.raw_data)
        json_dir = f"{self.dir}/{self.dir}.json"
        print('saved in ' + json_dir)
        with open(json_dir, 'w') as file:
            json.dump(res_dict, file, indent=4, ensure_ascii=False)

    def get_result(self):
        return json.dumps(self.raw_data)


# if __name__ == "__main__":
#     video_detect = DetectEmotion()
#     video_detect.start(filename="IMG_4635.mp4", fps=30)
#     print(video_detect.get_result())