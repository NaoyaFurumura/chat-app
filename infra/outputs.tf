output "bucket_name" {
    description = "プロフィール画像を保存するS3バケットの名前"
    value       = aws_s3_bucket.profile_images.bucket
}

output "aws_region" {
    description = "AWSリージョン"
    value       = var.aws_region
}

output "access_key_id" {
    description = "S3にアクセスするためのアクセスキーID"
    value       = aws_iam_access_key.app.id
}

output "secret_access_key" {
    description = "S3にアクセスするためのシークレットアクセスキー"
    value       = aws_iam_access_key.app.secret
    sensitive = true
}