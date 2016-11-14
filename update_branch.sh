#!/bin/bash

# YOU NEED TO CHECKOUT TO YOUR CURRENT BRANCH #

branch=$(git branch | sed -n -e 's/^\* \(.*\)/\1/p')

if [ "$branch" != "master" ]
then
	echo "Updating $branch to master"
	git checkout master && git pull &&
	git checkout $branch &&
	git rebase master
	#	git push
else
    echo "No update. You should checkout to your branch."
fi
	
	
