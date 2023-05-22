# Use it directly! 10 super useful Git command line codes


> So far, I have been using Git for a long time, and I thought of sharing some advanced git commands that are useful whether you are developing in a team or a personal project.

## 1. Output the changes of the last commit
This command, I use it a lot to send other people not using git to check out or integrate the changes. It will output the most recently committed changes to a zip file.

```bash
git archive -o ../updated.zip HEAD $(git diff --name-only HEAD^)
```

## 2. Output changes between two commits
Similarly, you can use this if you need to output the changes between some two commits.

```
git archive -o ../latest.zip NEW_COMMIT_ID_HERE $(git diff --name-only OLD_COMMIT_ID_HERE NEW_COMMIT_ID_HERE)
```

## 3. Clone the specified remote branch
This is very helpful if you are eager to clone only a specific branch of the remote repository, rather than the entire repository branch.

```bash
git init
git remote add -t BRANCH_NAME_HERE -f origin REMOTE_REPO_URL_PATH_HERE
git checkout BRANCH_NAME_HERE
```

## 4. Apply patches from unrelated local repositories
If you need some other unrelated local repository as a patch to your current repository, this is the shortcut to get there.

```bash
git --git-dir=PATH_TO_OTHER_REPOSITORY_HERE/.git format-patch -k -1 --stdout COMMIT_HASH_ID_HERE| git am -3 -k
```

## 5. Check if your branch's changes are part of other branches
The cherry command lets us check if changes from your branch appear in some other branch. It uses + or - symbols to show the changes between the current branch and the given branch: whether it is merged (merged). .+ indicates that it did not appear in the given branch, and conversely, - indicates that it appeared in the given branch. Here's how to check:

```bash
git cherry -v OTHER_BRANCH_NAME_HERE
#For example: to check with master branch
git cherry -v master <br>
```

## 6. Start a new branch with no history
Sometimes, you need to start a new branch, but you don't want to bring in a long, long history, for example, you want to put your code in the public area (open source), but you don't want others to know its history.

```bash
git checkout --orphan NEW_BRANCH_NAME_HERE
```

## 7. Checkout files from other branches without switching branches
Don't want to switch branches, but want to get the files you need from other branches:

```bash
git checkout BRANCH_NAME_HERE -- PATH_TO_FILE_IN_BRANCH_HERE
```

## 8. Ignore changes to tracked files

If you are working in a team and everyone is working on the same branch, then you are likely to use fetch and merge frequently. But sometimes this will reset your environment configuration file, so you have to modify it after each merge. With this command, you can ask git to ignore changes to specified files. In this way, if you merge again next time, this file will not be modified.

```bash
git update-index --assume-unchanged PATH_TO_FILE_HERE
```

## 9. Check whether the submitted changes are part of the release

The name-rev command can tell you where a commit is relative to the most recent release. Using this command, you can check whether the changes you made are part of the release.

```bash
git name-rev --name-only COMMIT_HASH_HERE
```

## 10. Use rebase push instead of merge

If you are working in a team and the whole team is working on the same branch, then you have to fetch/merge or pull frequently. In Git, the merge of branches is recorded by the submitted merge, which indicates when a feature branch is merged with the main branch. But in the case of multiple team members working together on a branch, the conventional merge will cause multiple messages to appear in the log, resulting in confusion. Therefore, you can use rebase when pulling to reduce useless merge messages and keep the history clear.

```bash
git pull --rebase
```

You can also configure a branch to always push with rebase:

```bash
git config branch.BRANCH_NAME_HERE.rebase true
```

English from: [Webdeveloperplus](http://webdeveloperplus.com/general/10-useful-advanced-git-commands/)

Chinese translation from: [OSChina](http://www.oschina.net/translate/10-useful-advanced-git-commands)