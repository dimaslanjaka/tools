const GulpClient = require("gulp");
const { join } = require("path");
const sharp = require("sharp");
const through2 = require("through2");

const inputFolder = join(__dirname, "../data");
const outputFolder = join(__dirname, "../result");

GulpClient.src(["**/*.{png,jpg,jpeg,webp}"], { cwd: inputFolder })
	.pipe(
		through2.obj(async (file, _enc, callback) => {
			if (file.isBuffer()) {
				const input = Buffer.from(file.contents);
				file.contents = await sharp(input).png().toBuffer();
				file.extname = ".png";
				return callback(null, file);
			}
			callback();
		})
	)
	.pipe(GulpClient.dest(outputFolder));
