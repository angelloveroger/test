###  GIT使用手册

|	命令	|	作用	|	备注	|
|-|:-:|:-:|
|>>> `git配置`   |   |   |
|git config [--local/global/system] --add section.key value |新增配置   |local:当前仓库配置；global:全局配置；system:系统配置|
|git config [--local/global/system] --get section.key   |获取配置   |local配置路径:当前仓库下.git/.gitconfig|
|git config [--local/global/system] --unset section.key |删除配置   |global配置路径:C:/Users/roger/.gitconfig|
|git config [--local/global/system] -l  |查看配置    |system配置路径:安装目录下 mingw64/etc/gitconfig|
|git config [--local/global/system] -e  |编辑配置项   |  |
|git config [--local/global/system] section.key value   |配置项赋值  |   |
|git config --list  |查看所有配置项    |   |
|>>> `初始化本地仓，代码回滚`   |   |   |
|git init   |初始化本地仓库|会在当前目录下创建.git文件夹|
|git add file|将修改的文件添加到暂存区|	|
|git commit -m 'remark'|提交到本地仓库|remark为提交备注信息，便于后期查看|
|git reset [--soft] HEAD~/gitId |代码从仓库检出到暂存区    |取消提交到仓库；将指针指向暂存区：即本地,暂存区为最新代码，仓库为上次提交的修改|
|   |[--mixed] HEAD~5/gitId |取消放入暂存区；将指针指向本地：即本地为最新修改，暂存区，仓库为前5次提交的修改|
|   |[--hard] HEAD~8/gitId  |代码回滚；将指针指向仓库：此时仓库，暂存区，本地代码都回退到前面第八次的修改| 
|git checkout -- file|代码从暂存区检出到本地   |从暂存区取上次放入的文件覆盖到本地|
|>>> `查看文件状态，提交记录，移除文件`   |   |   |
|git status |查看文件状态|红色：本地有修改未提交到暂存区；  绿色：暂存区未提交到版本库|
|git log    |查看提交历史|每次显示三条|
|git reflog |查看所有分支所有操作历史   |包括已经删除的操作|
|git rm [--cached] file|删除暂存区和本地文件|--cached：删除暂存区文件，本地保留|
|>>> `代码克隆，本地代码关联远程仓`   |   |   |
|git clone git@github.com:userName/repository.git  |从远程仓库克隆代码到本地    |userName:仓库用户名； repository:仓库名|
|git remote add origin git@github.com:userName/repository.git  |将本地仓库和远程仓库关联   |userName:仓库用户名； repository:仓库名|
|git push [-u] origin master    |代码推送远程仓库   |-u可以关联本地和远程仓库，简化之后的操作|
|>>> `git文件重命名`   |   |   |
|git mv [-f] oldname newname  |重命名    |-f强制性移动/重命名，如果新文件存在则会覆盖旧文件|
|git add [-u] newname |添加到暂存区 |-u会更新git已经跟踪的文件|
|>>> `ssh密匙`   |   |   |
|ssh-keygen -t rsa [-C 'remark']  |生成ssh密匙    |-C 'remark'为备注信息，密匙生成之后的路径位于：~/.ssh/|
|ssh -T git@github.com  |查看ssh连接状态   |查看当前电脑与远程机器的连接状态|
|>>> `git分支管理`   |    |   |
|git branch branchName  |创建分支 |branchName:分支名|
|git checkout branchName    |切换分支   |branchName:分支名|
|git checkout -b branchName   |新建分支，并切换到新的分支   |上两条命令合并为当前一条命令|
|git branch    |查看分支 |分支前面的星号表示当前所在的分支    |
|   |-a |查看远程仓所有分支|
|   |-v |查看当前仓库所有分支最后一次提交|
|   |--merged   |当前仓库已经被合并的分支|
|   |--no-merged    |当前仓库未被合并的分支|
|git merge branchName   |合并分支   |branchName:分支名  这个是要被合并的分支，即你当前所在的不是这个分支|
|git branch [-d] branchName   |删除分支   |branchName:分支名，仅删除被合并的分支|
|   |-D |被删除的分支未被合并，将不能直接删除，需要用到-D参数|

> ---
> |配置作用域|配置路径|
> |:-:|:-:|
> |--system|/etc/gitconfig|
> |--global|~/.gitconfig|
> |--local|.git/config/|
> ---
> |区域|文件状态|
> |:-:|:-:|
> |工作区|已修改/未修改|
> |暂存区|已暂存|
> |版本库/本地仓|已提交|
> ---

> ---
> |命令|作用|说明|文件状态变更|
> |:-:|:-:|:-:|:-:|
> |`git init`| 初始化`本地仓库`|在当前目录下创建`.git`目录用以追踪版本库中文件的变更|--|
> |`git status`|查看文件状态|`Untracked files`：（工作区）新增未暂存文件；`Changes not staged for commit`：（工作区）修改未暂存文件；`Changes to be committed`：（暂存区）[`new file`]新增已暂存文件/[`modified`]修改已暂存文件|--|
> |`git add [file]`|将当前`工作区`修改的文件添加到`暂存区`|当有多个文件需要添加到暂存区的时候，可以使用`*`代替|`已修改`-->`已暂存`|
> |`git rm --cached [file]`|移除`暂存区`中的文件|删除`暂存区`文件，保留`工作区`文件，并保留当前修改|`已暂存`-->`已修改`|
> |`git checkout -- [file]`|撤销修改|1.修改之后未添加到`暂存区`，执行命令会回到`版本库`中的状态；2.添加到`暂存区`之后又作了修改，执行命令会回到`暂存区`的状态|--|
> |`git log`|提交日志|可以倒序显示`提交ID`，`提交用户`，`提交时间`|--|
> ---



>##  常见问题说明
> ---
> ***1.git push的时候每次都要输入用户名和密码***
> - 原因是在添加远程库的时候使用了https的方式。所以每次都要用https的方式push到远程库
>> ---
>>  **①.查看使用的传输协议:**
>>
>>      $ git remote -v   
>>      origin  https://github.com/angelloveroger/study (fetch)
>>      origin  https://github.com/angelloveroger/study (push)
>> ---
>>  **②.重新设置成ssh的方式:**  
>>
>>     $ git remote rm origin  
>>     $ git remote add origin git@github.com:username/repository.git  
>>     $ git push -u origin master   
>> ---
>>  **③.再次查看使用的传输协议:**
>>
>>     $ git remote -v
>>     origin  git@github.com:angelloveroger/study.git (fetch)
>>     origin  git@github.com:angelloveroger/study.git (push)
>> ---

>  **2.删除远程仓库文件（夹），并保留本地**
>>
>>     $ git rm --cached (-r) fileName(/pathName)
>>     $ git commit -m 'remove fileName(pathName) remote respostory'
>>     $ git push
>> ---

>  **3.强行覆盖本地文件**        
>>     
>>     $ git fetch --all
>>     $ git reset --hard origin/master
>>     $ git pull
>> ---

> **4.从仓库拉取本地删除的文件（admin.php）**
>>
>>      $ git reset HEAD admin.php
>>      $ git checkout admin.php
>> ---


