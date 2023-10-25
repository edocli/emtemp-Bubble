# Bubble

EMLOG 清新风格响应式模板。

化繁为简，如沐清风。

移植自适用于Typecho的[Bubble](https://github.com/trinitrotofu/Bubble)主题。

如果觉得本模板还不错的话可以给个 star 哦，这是对开源模板作者们最大的鼓励。

# 特性

+ 清新的界面：大气简洁的页面布局，采用 argon design system，元素间隔恰到好处
+ 人性化的设计：登陆后显示后台管理按钮、醒目的文字、方便操作的按钮摆放，以及页面自适应
+ 流畅的用户体验：支持全站 pjax、ajax 实现评论无刷新，采用 cdnjs & jsDelivr 全球加速模板大部分静态资源加载，减小服务器压力
+ 短代码功能：使用模板特殊 HTML 标签实现更丰富的功能，如高亮代码框以及友链卡片
+ 自定义壁纸：首页固定壁纸、其他页面随机壁纸，彰显个性爱好
+ 代码高亮：自带 prism.js 代码高亮，模板丰富，解析迅速
+ 数学公式：自带 KaTeX 数学公式渲染，相比 MathJax 更为轻量、快速
+ 自定义样式：支持用户添加 css 样式，随意调整模板外观
+ 文件轻量：模板`.zip`格式安装包（去掉`.git`文件夹后）大小不到 250 KB，简洁而不简单

~~（原Bubble主题的文案）~~

# 使用

## 设置项

### 站点 LOGO

该项应为一个图片的 URL 地址，将显示在浏览器顶部标签标题左边。

请勿使用相对地址。

### 站点头像

该项应为一个图片的 URL 地址，将显示在首页大标题上方。

请勿使用相对地址。

### 首页背景图像

该项应为一个图片的 URL 地址，用以设定网站首页背景图片，留空则使用默认紫色渐变背景。

请勿使用相对地址。

### 随机背景图像地址

该项应为一个或多个图片的 URL 地址，用以设定网站文章页、独立页面以及其他页面的头图，设定后将从给定的图片中随机抽取一个显示，留空则使用默认紫色渐变背景。

URL 之间用换行隔开，即每行一个 URL，**请勿包含多余字符**。

请勿使用相对地址。

### 背景气泡

该项用以选择是否在首页以及文章页顶部背景处显示半透明气泡。

### 自定义 css

该项用以提供自定义 css 接口，用户可以填入自己需要的 css 代码来改变模板外观，例如更改字体大小。

自定义 css 的生效不需要清空缓存。

### 全站 pjax 模式

该项用以选择是否启用全站 pjax 模式提升用户访问体验。

请注意：开启该功能后可能会导致站点一些功能不正常，例如如果您未使用模板自带数学公式渲染，而是选择使用其他插件实现该功能，则会导致无刷新打开页面时数学公式插件不工作，因此请仔细检查后决定是否开启该模式。

如果您发现部分功能确实出现了问题，而您又希望开启该模式，则请查看“pjax 回调代码”一项的说明。

### pjax 回调代码

该项用以设定 pjax 渲染完毕后需执行的 JS 代码，以此解决上一项中提到的插件不工作之类的问题。

例如您有一个叫做`myFunction()`的函数在其他插件中调用了，但您发现它在全站 pjax 模式下不工作，则您应该在该项中填入以下内容：

```js
myFunction();
```

那么在 pjax 执行完毕之后会调用`myFunction()`，问题就解决了。

### katex 数学公式渲染

该项用以选择是否启用 katex 数学公式渲染。

### prism.js 代码高亮

该项用以选择是否启用 prism.js 代码高亮。

### prism.js 行号显示

该项用以选择代码高亮是否显示行号。

### prism.js 高亮主题

该项用以选择 prism.js 代码高亮的主题配色。

### ~~viewer.js 图片查看器~~（有问题，暂时下线）

~~该项用以选择是否启用 viewer.js 图片查看器（点击放大）。~~

### TOC 文章目录

该项用以选择是否启用 TOC 文章目录功能。

启用后将在文章页右侧显示一个可展开和关闭的 TOC 目录。

### TOC 目录展开状态

该项用以选择 TOC 目录栏是否默认展开。

### 自动截取摘要

该项用以选择文章是否自动截取摘要（关闭后若文章未手动设置摘要则显示全文）。

### 摘要截取字数

该项用以设定自动摘要截取长度，留空则默认截取 200 个字符。

## 短代码

*注意：若无法正常使用此功能，请尝试关闭第三方插件，如第三方文章编辑器。*

### 高亮代码框

标签名：

+ `bbcode`：高亮代码框标签

语法：

```html
<bbcode type="颜色类型">代码框内容</bbcode>
```

示例：

```html
<bbcode type="success">这是绿色高亮代码框，用以显示推荐信息</bbcode>
<bbcode type="danger">这是红色高亮代码框，用以显示警告信息</bbcode>
<bbcode type="warning">这是橙色高亮代码框，用以显示注意信息</bbcode>
<bbcode type="secondary">这是灰色高亮代码框，用以显示引用信息</bbcode>
<bbcode type="info">这是蓝绿色高亮代码框，用以显示高亮信息</bbcode>
<bbcode type="default">这是深蓝色高亮代码框，用以显示高亮信息</bbcode>
<bbcode type="primary">这是紫色高亮代码框，用以显示高亮信息</bbcode>
```

效果：

![bbcode.png](https://i.loli.net/2020/04/07/VEk37bUuXc1lyf6.png)

### 友链

标签名：

+ `bblist`：友链列表标签
+ `bblink`：友链项标签

语法：

```html
<bblist>
<bblink link="友链 URL" icon="友链图标 URL" des="友链描述">友链名称</bblink>
</bblist>
```

示例：

```html
<bblist>
<bblink link="https://tntofu.com" icon="https://tntofu.com/usr/uploads/2020/03/4228973783.jpg" des="三硝基豆腐的博客">豆腐蒸锅</bblink>
<bblink link="https://blog.boxpaper.club" icon="https://tntofu.com/usr/uploads/2020/04/2709766458.png" des="/ No Result !">Rorical</bblink>
</bblist>
```

效果：

![bblink.png](https://i.loli.net/2020/04/07/13ZtBldaNuxqrch.png)

# 截图

![screenshot.jpg](./preview.jpg)

# License

Open sourced under the `GNU GPL v3` license.

# 其他

+ 模板移植自由[三硝基豆腐](https://github.com/trinitrotofu)、[Rorical](https://github.com/Liupaperbox)和[Totorato](https://github.com/totorato)三人共同完成的Typecho [Bubble](https://github.com/trinitrotofu/Bubble)主题
+ 模板基于[Argon Design System](https://www.creative-tim.com/product/argon-design-system)
+ 部分代码参照了 EMLOG 官方模板 Default

# 更新日志

## `1.0.1` 10/26/2023

+ [feat] 支持首页选择是否展示头像
+ [feat] 支持首页随机背景图像
+ [feat] 暂时下线Viewer.js功能（有bug）
+ [feat] 优化底部边栏链接和标签样式
+ [fix] 修复部分页面右下角不显示浮动管理入口的问题
+ [fix] 修复作者文章列表页作者昵称显示不正确的问题

## `1.0.0` 10/21/2023

+ [feat] 支持自定义底部边栏版块
+ [feat] 新增底部边栏文章标签板块
+ [feat] 优化底部边栏链接样式
+ [fix] 修复移动端菜单页不展示关闭按钮的问题
+ [fix] 修复在开启pjax的情况下点击验证码无反应的问题

## `0.1.4` 10/15/2023

+ [feat] 添加了管理页和文章编辑页的快捷入口
+ [fix] 修复验证码可能无法加载的问题
+ [fix] 修复文章列表页无法正确获取分类的问题

## `0.1.3` 10/14/2023

+ [feat] 新增模板设置插件启用检测
+ [feat] 新增底部边栏热门文章板块
+ [feat] 优化404页面
+ [feat] 新增文章密码输入页面
+ [feat] 优化部分代码
+ [fix] 修复文章列表页标题“所有文章”显示问题

## `0.1.2` 10/11/2023

+ [feat] 底部边栏新增链接板块
+ [feat] 新增404页面
+ [feat] 优化文章列表页的标题内容
+ [feat] 优化主题包的体积
+ [fix] 修复文章列表页无法正确展示随机背景图片的问题

## `0.1.1` 10/08/2023

+ [feat] 新增底部边栏功能（暂仅支持最新评论、最新文章和存档功能）
+ [feat] 新增置顶文章显示置顶标记
+ [feat] 新增摘要自动截取功能（默认关闭）
+ [feat] 优化模板设置页面
+ [feat] 优化主题包的体积

## `0.1.0` 10/05/2023

+ 第一版发布咯