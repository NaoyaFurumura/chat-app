variable "aws_region"{
    description = "AWSリージョン"
    type = string
    default = "ap-northeast-1"
}

variable "profile_images_furufuru" {
    description = "プロフィール画像を保存するS3バケットの名前"
    type = string
    default = "profile-images-furufuru"
}

variable "app_name" {
    description = "アプリケーション名"
    type = string
    default = "sample-chat-app"
}