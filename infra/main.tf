resource "aws_s3_bucket" "profile_images" {
    bucket = var.profile_images_furufuru
}

resource "aws_s3_bucket_public_access_block" "profile_images" {
    bucket = aws_s3_bucket.profile_images.id

    block_public_acls = false
    block_public_policy = false
    ignore_public_acls = false
    restrict_public_buckets = false
}

resource "aws_s3_bucket_policy" "profile_images" {
    bucket = aws_s3_bucket.profile_images.id
    depends_on = [aws_s3_bucket_public_access_block.profile_images]

    policy = jsonencode({
        Version = "2012-10-17"
        Statement = [{
            Effect = "Allow"
            Principal = "*"
            Action = "s3:GetObject"
            Resource = "${aws_s3_bucket.profile_images.arn}/*"
        }]
    })
}

resource "aws_iam_user" "app" {
    name = "${var.app_name}-s3-user"
}

resource "aws_iam_user_policy" "app_s3" {
    name = "${var.app_name}-s3-policy"
    user = aws_iam_user.app.name

    policy = jsonencode({
        Version = "2012-10-17"
        Statement = [{
            Effect = "Allow"
            Action = [
                "s3:PutObject",
                "s3:DeleteObject"
            ]
            Resource = "${aws_s3_bucket.profile_images.arn}/*"
        }]
    })
}

resource "aws_iam_access_key" "app"{
    user = aws_iam_user.app.name
}