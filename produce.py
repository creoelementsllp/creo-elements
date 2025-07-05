import subprocess
import os


def run_production(commit_message):
    # Full path to npm (replace with the actual path from 'where npm')
    npm_path = r"C:\Program Files\nodejs\npm.cmd"  # Change this if necessary

    # Run npm build
    subprocess.run([npm_path, 'run', 'build'], check=True)

    # Change directory to 'react'
    os.chdir('./react')  # Change the current working directory

    # Stage all changes
    subprocess.run(['git', 'add', '.'], check=True)

    # Commit the changes with the provided commit message
    subprocess.run(['git', 'commit', '-m', commit_message], check=True)

    # Push the changes to the 'main' branch
    subprocess.run(['git', 'push', '-u', 'origin', 'main'], check=True)

    # Show the git status
    subprocess.run(['git', 'status'], check=True)

if __name__ == '__main__':
    # Prompt the user for a commit message
    commit_message = input("Enter your commit message: ")

    if not commit_message:
        print("Commit message cannot be empty.")
        exit(1)

    run_production(commit_message)