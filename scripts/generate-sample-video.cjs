const fs = require('node:fs');
const { chromium } = require('C:/Users/User/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');

(async () => {
  const browser = await chromium.launch({
    headless: true,
    executablePath: 'C:/Program Files/Google/Chrome/Application/chrome.exe',
  });
  const page = await browser.newPage();
  await page.goto('http://127.0.0.1:8005/', { waitUntil: 'domcontentloaded' });
  const video = await page.evaluate(async () => {
    const canvas = document.createElement('canvas');
    canvas.width = 960;
    canvas.height = 540;
    const context = canvas.getContext('2d');
    const sources = [
      ['/images/sample-community-circle.png', 'KNOWLEDGE'],
      ['/images/sample-service-recognition.png', 'LOVE'],
      ['/images/sample-mountain-sunrise.png', 'SERVICE'],
    ];
    const slides = await Promise.all(sources.map(([src, title]) => new Promise((resolve, reject) => {
      const image = new Image();
      image.onload = () => resolve({ image, title });
      image.onerror = reject;
      image.src = src;
    })));
    const stream = canvas.captureStream(24);
    const mime = ['video/webm;codecs=vp9', 'video/webm;codecs=vp8'].find(type => MediaRecorder.isTypeSupported(type));
    if (!mime) throw new Error('This browser cannot encode a WebM sample.');
    const recorder = new MediaRecorder(stream, { mimeType: mime, videoBitsPerSecond: 1200000 });
    const chunks = [];
    recorder.ondataavailable = event => { if (event.data.size) chunks.push(event.data); };
    const result = new Promise(resolve => { recorder.onstop = async () => resolve(await new Blob(chunks, { type: mime }).arrayBuffer()); });
    const started = performance.now();
    recorder.start();
    await new Promise(resolve => {
      const frame = now => {
        const elapsed = now - started;
        const index = Math.min(slides.length - 1, Math.floor(elapsed / 2200));
        const slide = slides[index];
        const scale = Math.max(canvas.width / slide.image.width, canvas.height / slide.image.height);
        const width = slide.image.width * scale;
        const height = slide.image.height * scale;
        const drift = Math.min(1, elapsed / 6500) * 24;
        context.drawImage(slide.image, (canvas.width - width) / 2 - drift, (canvas.height - height) / 2, width + drift * 2, height);
        const shade = context.createLinearGradient(0, 0, 0, canvas.height);
        shade.addColorStop(0, 'rgba(4,17,40,.1)');
        shade.addColorStop(1, 'rgba(4,17,40,.88)');
        context.fillStyle = shade;
        context.fillRect(0, 0, canvas.width, canvas.height);
        context.fillStyle = '#e7bd57';
        context.font = '600 24px Arial';
        context.letterSpacing = '5px';
        context.fillText('UECFI DISTRICT 23 FYS', 56, 72);
        context.fillStyle = '#fff';
        context.font = '700 54px Arial';
        context.letterSpacing = '1px';
        context.fillText(slide.title, 56, 428);
        context.fillStyle = 'rgba(255,255,255,.84)';
        context.font = '24px Arial';
        context.fillText('Knowledge · Love · Service', 56, 472);
        context.fillStyle = '#e7bd57';
        context.fillRect(56, 495, Math.max(20, (elapsed % 2200) / 2200 * 300), 3);
        if (elapsed >= 6600) resolve();
        else requestAnimationFrame(frame);
      };
      requestAnimationFrame(frame);
    });
    recorder.stop();
    const buffer = await result;
    return Array.from(new Uint8Array(buffer));
  });
  fs.writeFileSync('public/images/sample-uecfi-slideshow.webm', Buffer.from(video));
  await browser.close();
  console.log('Generated public/images/sample-uecfi-slideshow.webm');
})().catch(error => { console.error(error); process.exit(1); });
