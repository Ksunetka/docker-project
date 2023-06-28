const eventsForListen = [
    'users.created',
    'users.updated',
    'users.deleted',
];

const channelName = `broadcast-messages`;
const channel = Echo.channel(channelName);
for (let eventForListen of eventsForListen) {
    channel.listen('.' + eventForListen, (e) => {
        eventBus.$emit(eventForListen, e);
    });
}
