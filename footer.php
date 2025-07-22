					<footer id="footer" class="site-footer card shadow-sm border-0">
						<?php
							echo get_option('argon_footer_html');
						?>
						<!-- 字数统计-->.
						<?php echo get_site_word_count_comparison_filtered(); ?>

						
						<div>Theme <a href="https://github.com/solstice23/argon-theme" target="_blank"><strong>Argon</strong></a><?php if (get_option('argon_hide_footer_author') != 'true') {echo " By solstice23"; }?></div>
						
					
					</footer>
				</main>
			</div>
		</div>
		<script src="<?php echo $GLOBALS['assets_path']; ?>/argontheme.js?v<?php echo $GLOBALS['theme_version']; ?>"></script>
		<?php if (get_option('argon_math_render') == 'mathjax3') { /*Mathjax V3*/?>
			<script>
				window.MathJax = {
					tex: {
						inlineMath: [["$", "$"], ["\\\\(", "\\\\)"]],
						displayMath: [['$$','$$']],
						processEscapes: true,
						packages: {'[+]': ['noerrors']}
					},
					options: {
						skipHtmlTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code'],
						ignoreHtmlClass: 'tex2jax_ignore',
						processHtmlClass: 'tex2jax_process'
					},
					loader: {
						load: ['[tex]/noerrors']
					}
				};
			</script>
			<script src="<?php echo get_option('argon_mathjax_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@3/es5/tex-chtml-full.js' : get_option('argon_mathjax_cdn_url'); ?>" id="MathJax-script" async></script>
		<?php }?>
		<?php if (get_option('argon_math_render') == 'mathjax2') { /*Mathjax V2*/?>
			<script type="text/x-mathjax-config" id="mathjax_v2_script">
				MathJax.Hub.Config({
					messageStyle: "none",
					tex2jax: {
						inlineMath: [["$", "$"], ["\\\\(", "\\\\)"]],
						displayMath: [['$$','$$']],
						processEscapes: true,
						skipTags: ['script', 'noscript', 'style', 'textarea', 'pre', 'code']
					},
					menuSettings: {
						zoom: "Hover",
						zscale: "200%"
					},
					"HTML-CSS": {
						showMathMenu: "false"
					}
				});
			</script>
			<script src="<?php echo get_option('argon_mathjax_v2_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/mathjax@2.7.5/MathJax.js?config=TeX-AMS_HTML' : get_option('argon_mathjax_v2_cdn_url'); ?>"></script>
		<?php }?>
		<?php if (get_option('argon_math_render') == 'katex') { /*Katex*/?>
			<link rel="stylesheet" href="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>katex.min.css">
			<script src="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>katex.min.js"></script>
			<script src="<?php echo get_option('argon_katex_cdn_url') == '' ? '//cdn.jsdelivr.net/npm/katex@0.11.1/dist/' : get_option('argon_katex_cdn_url'); ?>contrib/auto-render.min.js"></script>
			<script>
				document.addEventListener("DOMContentLoaded", function() {
					renderMathInElement(document.body,{
						delimiters: [
							{left: "$$", right: "$$", display: true},
							{left: "$", right: "$", display: false},
							{left: "\\(", right: "\\)", display: false}
						]
					});
				});
			</script>
		<?php }?>

		<?php if (get_option('argon_enable_code_highlight') == 'true') { /*Highlight.js*/?>
			<link rel="stylesheet" href="<?php echo $GLOBALS['assets_path']; ?>/assets/vendor/highlight/styles/<?php echo get_option('argon_code_theme') == '' ? 'vs2015' : get_option('argon_code_theme'); ?>.css">
		<?php }?>

	</div>
</div>
<?php 
	wp_enqueue_script("argonjs", $GLOBALS['assets_path'] . "/assets/js/argon.min.js", null, $GLOBALS['theme_version'], true);
?>
<?php wp_footer(); ?>



<style>
/* 日间模式 */
.nav-link-inner--text,
.banner-title-inner,
.footer-link,
.banner-subtitle,
.footer-links{
    color: #525f7f;
}

/* 暗色模式 */
html.darkmode .nav-link-inner--text,
html.darkmode .banner-title-inner,
html.darkmode .footer-link,
html.darkmode .banner-subtitle,
html.darkmode .footer-links{
    color: #ffffff !important;
}


</style>



<!-- 标题自动锚点: Start -->
<script>
window.addEventListener('load', function() {
    // 构建标题文本与 Argon ID 的映射表
    const headers = document.querySelectorAll('h1[id], h2[id], h3[id], h4[id], h5[id], h6[id]');
    const textToIdMap = new Map();
    headers.forEach(header => {
        const id = header.id;
        const text = header.textContent.trim();
        textToIdMap.set(text, id); // 标题文本 -> ID 映射
    });
 
    // 替换页面中的基于文本的锚点链接
    const links = document.querySelectorAll('a[href^="#"]');
    links.forEach(link => {
        const targetText = decodeURIComponent(link.getAttribute('href').slice(1)); // 获取锚点文本
        if (textToIdMap.has(targetText)) {
            link.setAttribute('href', `#${textToIdMap.get(targetText)}`); // 替换为 Argon 的 ID
        }
    });
 
    //文外跳转
    if (window.location.hash) {
        const hash = window.location.hash.slice(1);  // 去掉 #
        let targetElement;
        // 优先检查哈希值是否是一个有效的 ID
        targetElement = document.getElementById(hash);
        if (!targetElement) {
            // 如果哈希值是标题文本，检查映射表
            const decodedHash = decodeURIComponent(hash);  // 解码哈希值
            if (textToIdMap.has(decodedHash)) {
                const targetId = textToIdMap.get(decodedHash);  // 获取对应的 ID
                targetElement = document.getElementById(targetId);  // 查找对应 ID 的元素
            }
             // 替换图片的 src 属性
            const lazyImages = document.querySelectorAll('img.lazyload[data-original]');
            lazyImages.forEach(img => {
                img.src = img.getAttribute('data-original'); // 直接替换为真正的图片链接
            });
        }
        // 如果找到了目标元素，滚动到该元素
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
});
</script>
<!-- 标题自动锚点: End -->


<!-- 杂项 -->
<style>
/* 设置右下角的aplayer播放器的字体颜色*/
.aplayer-list-title,
.aplayer-title {
  color: #525f7f; 
}
/* 副标题斜体 */
.banner-subtitle d-block {
font-style: oblique;
}
.banner-subtitle d-block typing-effect {
font-style: oblique;
}
/* 将根元素（html）的字体大小设置为原来的 110% */
html {
  font-size: 102%;
} !important

/* 确保所有使用 em/rem 单位的文字都会相应放大 */
body {
  font-size: 1rem; /* 如果你之前有对 body font-size 做过覆盖，请保留此行 */
}
</style>
<!-- 全局文字放大
<script>
  document.addEventListener("DOMContentLoaded", function() {
    // 获取所有可见元素
    var all = document.getElementsByTagName("*");
    for (var i = 0; i < all.length; i++) {
      var el = all[i];
      // 读取当前计算后的字体大小
      var style = window.getComputedStyle(el, null).getPropertyValue("font-size");
      var currentSize = parseFloat(style);
      // 设置为原来的 110%
      el.style.fontSize = (currentSize * 1.02) + "px";
    }
  });
</script>
-->


<!-- 如果你想在控制台输出一些消息，可以使用以下代码：
<script>
  const style1 = 'color: #fff; background: #4caf50; padding: 6px 12px; border-radius: 4px; font-size: 16px;';
  console.log('🎉', style1);
</script>
-->


<!--全页特效开始-->
<!--鼠标跟随特效，允许任何设备
<script type="text/javascript">
    $.getScript("https://loneapex.cn/extra-js/beauty/mouse-click.js"); //小烟花特效
    $.getScript("https://loneapex.cn/extra-js/beauty/fairyDustCursor.min.js"); // 鼠标移动的仙女棒特效
</script>-->

<!-- 鼠标跟随特效特效，设备检测（如果允许任何设备则把判断删了，或者使用上面的代码）-->
<script src="<?php echo $GLOBALS['assets_path']; ?>/extra-js/beauty/mobile-detect.js"></script>
<script type="text/javascript">
    // 设备检测
    var md = new MobileDetect(window.navigator.userAgent);
    // PC生效，手机/平板不生效
    // md.mobile(); md.phone();
    if(!md.phone()){
        if(!md.tablet()){
            // 雪花特效
            // $.getScript("<?php echo $GLOBALS['assets_path']; ?>/extra-js/beauty/xiaxue.js");
            // 樱花特效
            // $.getScript("<?php echo $GLOBALS['assets_path']; ?>/extra-js/beauty/yinghua2.js");
            // 小烟花特效
            // $.getScript("<?php echo $GLOBALS['assets_path']; ?>/extra-js/beauty/mouse-click.js");
            // 鼠标移动的仙女棒特效
            // $.getScript("<?php echo $GLOBALS['assets_path']; ?>/extra-js/beauty/fairyDustCursor.min.js");
        }   
    }
</script>

<!--星空＋鼠标粒子效果-->
<canvas id="canvas"></canvas>
<style>
    #canvas {
      position: fixed;     /* 固定在视口 */

      top: 0;
      left: 0;
      z-index: -1;         /* 放到内容后面 */
    }
</style>
<script>
    // DOM 加载后再初始化,确保脚本在 Canvas 元素加载完毕后执行
    document.addEventListener('DOMContentLoaded', function() {
      setCanvasSize();
      init();
      window.addEventListener('resize', setCanvasSize);
    });
    // 用户可能会改变浏览器大小，最好在 resize 时也更新 Canvas 大小：
    function setCanvasSize() {
      WIDTH = document.documentElement.clientWidth;
      HEIGHT = document.documentElement.clientHeight;
      canvas.width = WIDTH;
      canvas.height = HEIGHT;
    }
    window.addEventListener('resize', setCanvasSize);

</script>
<script type="text/javascript" src="<?php echo $GLOBALS['assets_path']; ?>/extra-js/beauty/star_style.js"></script>
<!--星空＋鼠标粒子效果 结束-->






<script>
  function hexToRgb(hex,op){
    let str = hex.slice(1);
    let arr;
    if (str.length === 3) arr = str.split('').map(d => parseInt(d.repeat(2), 16));
    else arr = [parseInt(str.slice(0, 2), 16), parseInt(str.slice(2, 4), 16), parseInt(str.slice(4, 6), 16)];
    return  `rgb(${arr.join(', ')}, ${op})`;
};
 
  let themeColorHex = getComputedStyle(document.documentElement).getPropertyValue('--themecolor').trim();
  let op1 = 0.8
  let themeColorRgb = hexToRgb(themeColorHex,op1);
  let themecolorGradient = getComputedStyle(document.documentElement).getPropertyValue('--themecolor-gradient')*
  document.documentElement.style.setProperty('--themecolor-gradient',themeColorRgb)
 
  let op2 = 0.8
  // 方法一：
  let colorTint92 = getComputedStyle(document.documentElement).getPropertyValue('--color-tint-92').trim();
  colorTint92 += ', '+op2;
  document.documentElement.style.setProperty('--color-tint-92',colorTint92)
  // 方法二：（无效）
  // let colorForegroundHex = getComputedStyle(document.documentElement).getPropertyValue('--color-foreground').trim();
  // let colorForeground = hexToRgb(colorForegroundHex,op2)
  // 无效的原因是博客里的--color-fpreground是局部变量，不是:root里的全局变量，所以最好的办法是修改--color-tint-92，这个是全局的
  // document.documentElement.style.setPrope。rty('--color-fpreground',colorForeground)
   // 不要用下面这种cssText这种写法，会导致上面--themecolor-gradient的样式修改失效！
   // document.documentElement.style.cssText = '--color-tint-92:'+colorTint92
  
  let op3 = 0.8
  let colorShade90 = getComputedStyle(document.documentElement).getPropertyValue('--color-shade-90').trim();
  colorShade90 += ', ' + op3;
  document.documentElement.style.setProperty('--color-shade-90',colorShade90)
 
  let op4 = 0.8
  let colorShade86 = getComputedStyle(document.documentElement).getPropertyValue('--color-shade-86').trim();
  colorShade86 += ', ' + op4;
  document.documentElement.style.setProperty('--color-shade-86',colorShade86)
</script>









</body>
<?php echo get_option('argon_custom_html_foot'); ?>

</html>

