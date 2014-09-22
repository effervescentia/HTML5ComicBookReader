# -*- mode: ruby -*-
# vi: set ft=ruby :

# Vagrantfile API/syntax version. Don't touch unless you know what you're doing!
VAGRANTFILE_API_VERSION = "2"

def customize(vb)
  vb.customize ["modifyvm", :id, "--acpi", "on"]
  vb.customize ["modifyvm", :id, "--ioapic", "on"]
  vb.customize ["modifyvm", :id, "--pae", "on"]
  vb.customize ["modifyvm", :id, "--rtcuseutc", "on"]
  vb.customize ["modifyvm", :id, "--cpus", "2"]
  vb.customize ["modifyvm", :id, "--cpuexecutioncap", "75"]
end
def forward(c, name, guest, host)
  c.vm.network :forwarded_port, id: name, guest: guest, host: host
end

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|
  vms = [
    {
      :name => "test",
      :mem  => 2048,
      :download => false,
      :ip => "192.168.33.10"
    }
  ]
  vms.each do |vmdef|
    config.vm.define vmdef[:name] do |c|
      c.vm.box = "centos64"
      c.vm.box_url = "https://github.com/2creatives/vagrant-centos/releases/download/v0.1.0/centos64-x86_64-20131030.box"

      c.vm.network :private_network, ip: vmdef[:ip]

      c.vm.hostname = vmdef[:name]
      c.vm.provider :virtualbox do |vb|
        vb.name = vmdef[:name]
        vb.memory = vmdef[:mem]
        customize vb
      end
    end
  end
end
