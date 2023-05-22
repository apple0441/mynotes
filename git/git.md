# Git setup and usage help


> Reference website:
http://rogerdudler.github.io/git-guide/index.zh.html
http://git.oschina.net/progit/

### 1. Check if there is already an SSH Key

```bash
cd ~/.ssh
```

### 2. Generate a new SSH Key

```bash
ssh-keygen -t rsa -C "admin@example.com"
```
Please replace `admin@example.com` with your own email address. After that, press Enter directly without filling in anything. You will then be asked to enter a passphrase (`passphrase`). Then a directory `.ssh` is generated, which contains two files: `id_rsa` and `id_rsa.pub`.

### 3. Git configuration

**1. Configure user information**

```bash
git config --global user.name "John Doe"
git config --global user.email "johndoe@example.com"
```

Please replace `John Doe` with your commonly used English network `ID`, and `johndeo@exaple.com` with your commonly used `Email`.

**2. Get help**

If you want to know how to use the various tools of `Git`, you can read their help. There are three methods:

```bash
git help <verb>
git <verb> --help
man git -<verb>
```

For example, to learn how the `config` command can be used, run:

```bash
git help config
```

### 4. Git related operation commands


**1. Create a new warehouse**

Create a new folder, open it, and execute:

```bash
git init
```

to create a new git repository.

**2. Check out the repository**

Execute the following command to create a clone of the local repository:

```bash
git clone /path/to/repository
```

If it is a warehouse on a remote server, your command will look like this:

```bash
git clone username@host:/path/to/repository
```

**3. Workflow**

Your local repository consists of three "trees" maintained by `git`. The first is your working directory, which holds the actual files; the second is the cache (`Index`), which is like a cache area, temporarily storing your changes; and the last is `HEAD`, which points to your latest commit after the result.

**4. Add and Submit**

You can schedule changes (add them to the cache) with the following command:

```bash
git add <filename>
git add *
```

This is the first step in the basic git workflow; use the following command to actually commit the changes:

```bash
git commit -m "code commit information"
```

Now, your changes have been committed to `HEAD`, but not to your remote repository.

**5. Push changes**

Your changes are now in HEAD of your local repository. Execute the following command to submit these changes to the remote repository:

```bash
git push origin master
```

You can replace `master` with whatever branch you want to push.

If you haven't cloned an existing repository and want to connect your repository to a remote server, you can add it with the following command:

```bash
git remote add origin <server>
```

This way you can push your changes to the added server.

**6. Branch**

Branches are used to insulate feature development. `master` is the "default" when you create a repository. Do development on other branches and merge them into the main branch when you're done.

Create a branch called `feature_x` and switch to it:

```bash
git checkout -b feature_x
```

Switch back to the master branch:

```bash
git checkout master
```

Then delete the newly created branch:

```bash
git branch -d feature_x
```

Unless you push the branch to a remote repository, the branch is invisible to others:

```bash
git push origin <branch>
```

**7. Update and Merge**

To update your local repository with the latest changes, execute:

```bash
git pull
```

to fetch (`fetch`) and merge (`merge`) remote changes in your working directory.
To merge other branches into your current branch (e.g. `master`), execute:

```bash
git merge <branch>
```

In both cases, `git` will attempt to automatically merge the changes. Unfortunately, automatic merging does not always succeed and can lead to conflicts (`conflicts`). At this time, you need to modify these files to manually merge these conflicts (`conflicts`). After making changes, you need to execute the following command to mark them as merged successfully:

```bash
git add <filename>
```
Before merging changes, you can also use the following command to view:

```bash
git diff <source_branch> <target_branch>
```

**8. Label**

Creating tags when software is released is recommended. This is an old concept, also in `SVN`. To create a tag called `1.0.0`, execute the following command:

```bash
git tag 1.0.0 1b2e1d63ff
```

`1b2e1d63ff` is the first 10 characters of the commit `ID` you want to tag. Get the commit `ID` using the following command:

```bash
git log
```
You can also use less of the first few digits of the commit `ID`, as long as it is unique.

**9. Replace local changes**

If you do something wrong (which is impossible, of course), you can replace your local changes with:

```bash
git checkout --<filename>
```

This command will replace the files in your working directory with the latest contents from `HEAD`. Changes already added to the cache, as well as new files, are unaffected.

If you want to discard all your local changes and commits, you can get the latest version from the server and point your local master branch to it:

```bash
git fetch origin
git reset --hard origin/master
```

**10. Create and submit a Git repository on the command line**

```bash
mkdir example
cd example
git init
echo "# example" >> README.md
git add README.md
git commit -m "first commit"
git remote add origin git@github.com:ycrao/example.git
git push -u origin master
```

**11. Submit an existing project on the command line**

```bash
cd existing_git_repo
git remote add origin git@github.com:ycrao/existing_git_repo.git
git push -u origin master
```

Note: `git@github.com:ycrao/example.git` or `git@github.com:ycrao/existing_git_repo.git` in the examples 10 and 11 is the address of the warehouse `SSH`, and the general source code hosting service provider ( Such as `GitHub` and `Coding`) will inform you on the warehouse page, please replace it yourself according to the actual situation and operation.