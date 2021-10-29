<!DOCTYPE html>
<html lang="en">

    @if (auth()->check() && auth()->user()->groupId==1)
        <livewire:admin.sections.header/>
    @elseif((auth()->check() && auth()->user()->groupId==2))
        <livewire:customers.sections.header/>
    @else
        <livewire:site.sections.header/>
    @endif

    {{$slot}}

    @if (auth()->check() && auth()->user()->groupId==1)
        <livewire:admin.sections.footer/>
    @elseif((auth()->check() && auth()->user()->groupId==2))
        <livewire:customers.sections.footer/>
    @else
        <livewire:site.sections.footer/>
    @endif

</body>
</html>
