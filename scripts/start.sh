# Start server
# port
port=$1

if [ -z "$port" ]; then
    echo "Please input port: ./start.sh <port>"
    exit 1
fi

# Check env
if [ ! -f .env ]; then
    echo "Please create .env file"
    exit 1
fi

# Load env
set -a
source .env
set +a

# Start
php -S 0.0.0.0:$port -t src