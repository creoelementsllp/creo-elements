import subprocess
import sys

def run_production(commit_message):
    # Full path to npm (replace with the actual path from 'where npm')
    npm_path = r"C:\Program Files\nodejs\npm.cmd"  # Change this if necessary

    # Run npm build
    subprocess.run([npm_path, 'run', 'build'], check=True)

    # Change directory to 'react'
    subprocess.run(['cd', 'react'], shell=True, check=True)

    # Stage all changes
    subprocess.run(['git', 'add', '.'], check=True)

    # Commit the changes with the provided commit message
    subprocess.run(['git', 'commit', '-m', commit_message], check=True)

    # Push the changes to the 'main' branch
    subprocess.run(['git', 'push', '-u', 'origin', 'main'], check=True)

    # Show the git status
    subprocess.run(['git', 'status'], check=True)

if __name__ == '__main__':
    # Ensure a commit message is provided as an argument
    if len(sys.argv) < 2:
        print("Usage: python production.py 'Your commit message'")
        sys.exit(1)

    commit_message = sys.argv[1]
    run_production(commit_message)
